<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\category;
use DB;

class CategoriesController extends Controller
{
    //for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }


    //
    function getData(){
        $data['data'] = DB::table('categories')->get();

        if(count($data) > 0){
            return view('pages/categories_page', $data);
        }
        else{
            return view('pages/categories_page');
        }
    }

<<<<<<< HEAD


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $updatecat = category::findOrFail($request->catid);

        $updatecat->catname =  $request['catname'];
        $updatecat->catdesc = $request['catdesc'];

        $updatecat->save();

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

=======
    function insert(Request $req){
        $catname = $req->input('catname');
        $catdesc = $req->input('catdesc');
        $data = array('catname'=>$catname,'catdesc'=>$catdesc,'createdat'=>NOW(),'updatedat'=>NULL);
        DB::table('categories')->insert($data);

        return back();
    }
>>>>>>> f9e7992a303ea8697bbebdb4ca642f366e5fa838
}
