<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon;
use App\Models\Color;


class ColorController extends Controller
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
        $colors = DB::table('colors')->orderBy('created_at', 'desc')->paginate(10);
        return view('color.colors-list', ['colors' => $colors]);
    
    }
    /**
     * show the application of  create page
     *
     * @return void
    */
    public function create()
    {
        return view('color.colors-add');
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
            'color'      => 'required',
        ]);
        
        $color            = new Color;
        $color->name       = $input['color'];
        $color->created_at = $today;
        $color->updated_at = $today;

        $color->save();

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
        $color = DB::table('colors')->find($id);
        return view('color.color-edit')->with([ 'color' => $color ]);
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
            'color'                  => 'required',
        ]);
        $today     = Carbon\Carbon::now();
        $aUpdate     =  [];
        $input       =  $request->all();
        $id          =  $input['id'];
        
        $aUpdate     = [
            'name'          =>  $input['color'],
            'updated_at'    =>  $today
        ];
      
    
        $color = DB::table('colors')
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
        $colors = DB::table('colors')->find($id);
        return view('color.color-show')->with([ 'color' => $colors ]);
    } 
    /**
    * delete the specified resource.
    *
    * @param  \App\request  $request
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $colors = Color::find( $id )->delete();
        return redirect()->back();
    }
}
