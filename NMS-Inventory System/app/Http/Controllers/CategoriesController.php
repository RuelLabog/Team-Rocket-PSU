<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    function insert(Request $req){
        $catname = $req->input('catname');
        $catdesc = $req->input('catdesc');
        $data = array('catname'=>$catname,'catdesc'=>$catdesc,'createdat'=>NOW(),'updatedat'=>NULL);
        DB::table('categories')->insert($data);
    }
}
