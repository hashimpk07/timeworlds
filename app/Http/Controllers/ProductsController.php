<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon;
use App\Models\Products;
use App\Models\Size;
use App\Models\Color;
use App\Models\ProductsColor;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = DB::table('products')
            ->select('products.name as productName','products.id as productId', 'products.image as productimage', 'description as productdescription','size.name as sizeName', DB::raw("GROUP_CONCAT(colors.name) as colorName"))
            ->join('products_color','products_color.product_id','=','products.id')
            ->join('colors','colors.id','=','products_color.colors_id')
            ->join('size','size.id','=','products.size_id')
            ->groupBy('products.id')
            ->orderBy('products.created_at', 'desc')
            ->paginate(10);
        return view('product.product-list', ['products' => $products]);
    }
     /**
     * show the application of  create page
     *
     * @return void
    */
    public function create()
    {
        $colors  = Color::all('id', 'name');
        $sizes   = Size::all('id', 'name');;
        return view('product.product-add',["colors" => $colors,"sizes" => $sizes]);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function store(Request $request)
    { 
        $input = $request->all();
        $today     = Carbon\Carbon::now();

        $validatedData = $request->validate([
            'productName'          => 'required',
            'productSize'          => 'required',
            'productColors'        => 'required|array',
            'product_input_image'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);
        
        //insert new file
        if ($files = $request->file('product_input_image')) {
            $destinationPath = 'images/'; 
            $productImage    = time()."-".$request->productName.".".$files->getClientOriginalExtension();
           $files->move($destinationPath, $productImage);
        }else{
            $productImage = NULL;
        }

        $products = Products::create([
            'name'        => $input['productName'],
            'description' => $input['description'],
            'size_id'     => $input['productSize'],
            'image'       => $productImage,
            'created_at'  => $today,
            'updated_at'  => $today,
        ]);

        if ( 0 != $products->id ){
            for ($i = 0; $i < count($request->productColors); $i++) {
                $productColors[] = [
                    'product_id' => $products->id,
                    'colors_id'   => $request->productColors[$i],
                    'created_at'  => $today,
                    'updated_at'  => $today,
                ];
            }
            ProductsColor::insert($productColors);
        }

        return response()->json(['status'=>'success']); 
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\request  $request
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $colors  = Color::all('id', 'name');
        $sizes   = Size::all('id', 'name');
        $products = DB::table('products')
            ->select('products.name as productName','products.id as productId', 'products.image as productimage', 'description as productdescription','size.name as sizeName','products.size_id as productSizeId', DB::raw("GROUP_CONCAT(colors.id) as colorId"))
            ->join('products_color','products_color.product_id','=','products.id')
            ->join('colors','colors.id','=','products_color.colors_id')
            ->join('size','size.id','=','products.size_id')
            ->where('products.id', '=',$id )
            ->get();

        return view('product.product-edit',["products" =>$products[0],"colors" => $colors,"sizes" => $sizes]);
    } 
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserData  $userData
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request)
    {
        $input     =   $request->all();
        $today     =   Carbon\Carbon::now();
        $aUpdate   =   [];
        $id        =   $input['id'];
        $prodColors=   [];

        $validatedData = $request->validate([
            'productName'          => 'required',
            'productSize'          => 'required',
            'productColors'        => 'required|array',
            'product_input_image'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);
        

         $aUpdate     = [
            'name'          =>  $input['productName'],
            'description'   =>  $input['description'],
            'size_id'       =>  $input['productSize'],
            'updated_at'    =>  $today
        ];
        //insert new file
        if ($files = $request->file('product_input_image')) {
            $destinationPath = 'images/'; 
            $productImage    = time()."-".$request->productName.".".$files->getClientOriginalExtension();
           $files->move($destinationPath, $productImage);
           $aUpdate['image']  = $productImage;
        }
      
        $products = DB::table('products')
            ->where('id', $id)
            ->update($aUpdate);

        if ( !empty($request->productColors) ){
            $prdColor=ProductsColor::where('product_id',$id)->delete();
            for ($i = 0; $i < count($request->productColors); $i++) {
                $productColors[] = [
                    'product_id'  => $id,
                    'colors_id'   => $request->productColors[$i],
                    'created_at'  => $today,
                    'updated_at'  => $today,
                ];
            }
            ProductsColor::insert($productColors);

            
        }else{
            $prdColor=ProductsColor::where('product_id',$id)->delete();
        }
        return response()->json(['status'=>'success']);
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\request  $request
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $colors  = Color::all('id', 'name');
        $sizes   = Size::all('id', 'name');
        $products = DB::table('products')
            ->select('products.name as productName','products.id as productId', 'products.image as productimage', 'description as productdescription','size.name as sizeName','products.size_id as productSizeId', DB::raw("GROUP_CONCAT(colors.id) as colorId"))
            ->join('products_color','products_color.product_id','=','products.id')
            ->join('colors','colors.id','=','products_color.colors_id')
            ->join('size','size.id','=','products.size_id')
            ->where('products.id', '=',$id )
            ->get();

        return view('product.product-show',["products" =>$products[0],"colors" => $colors,"sizes" => $sizes]);
    } 
    /**
    * delete the specified resource.
    *
    * @param  \App\request  $request
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $products    = Products::find( $id )->delete();
        $prdColor    = ProductsColor::where('product_id',$id)->delete();
        return redirect()->back();
    }
    
}
