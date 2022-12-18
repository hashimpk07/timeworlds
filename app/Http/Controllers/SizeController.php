<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon;
use App\Models\Size;

class SizeController extends Controller
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
        $sizes = DB::table('size')->orderBy('created_at', 'desc')->paginate(10);
        return view('size.size-list', ['sizes' => $sizes]);
    
    }
    /**
     * show the application of  create page
     *
     * @return void
    */
    public function create()
    {
        return view('size.size-add');
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
            'size'      => 'required',
        ]);
        
        $size            = new Size;
        $size->name       = $input['size'];
        $size->created_at = $today;
        $size->updated_at = $today;

        $size->save();

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
        $size = DB::table('size')->find($id);
        return view('size.size-edit')->with([ 'size' => $size ]);
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
        request()->validate([
            'size'                  => 'required',
        ]);
        $today     = Carbon\Carbon::now();
        $aUpdate     =  [];
        $input       =  $request->all();
        $id          =  $input['id'];
        
        $aUpdate     = [
            'name'          =>  $input['size'],
            'updated_at'    =>  $today
        ];
      
    
        $size = DB::table('size')
            ->where('id', $id)
            ->update($aUpdate);
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
        $size = DB::table('size')->find($id);
        return view('size.size-show')->with([ 'size' => $size ]);
    } 
    /**
    * delete the specified resource.
    *
    * @param  \App\request  $request
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $size = Size::find( $id )->delete();
        return redirect()->back();
    }
    public function fetchData(Request $request)
    {
       if($request->ajax()){
            $flag = 0;
            $name;
            $query = $request->get('query');
            if( 1 ==$query ){
                $name = 'Test 1';
                $flag = 1;
            }else if( 2 ==$query ){
                $name ='Test 2';
                $flag = 1;
            }else if( 3 ==$query ){
                $name ='Test 3';
                $flag = 1;
            }else{
                $sizes = $sizes = DB::table('size')->orderBy('created_at', 'desc')->paginate(10);
                $flag  = 0;
            }
            if( 0 != $flag ){
                 $sizes = DB::table('size')->where('name', '=', $name)->paginate(10);
            }
            return view('size.size_data', compact('sizes'))->render();
       }
    }
}
