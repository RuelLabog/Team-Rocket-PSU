<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ItemsController extends Controller
{
    // for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Retreiving of Data.
    function getData(){
        $data['data'] = DB::table('items')->get();

        if(count($data) > 0){
            return view('pages/items_page', $data);
        }
        else{
            return view('pages/items_page');
        }
    }
}

