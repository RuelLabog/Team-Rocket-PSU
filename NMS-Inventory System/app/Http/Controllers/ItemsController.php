<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidateRequests;
use Illuminate\Foundation\Validation\AuthorizesRequests;
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

    function insert(Request $req){
        $itemname = $req->input('itemname');
        $itemdesc = $req->input('itemdesc');
        $price = $req->input('price');
        $quantity = $req->input('quantity');
        $catid = $req->input('catid');
        $data = array('itemname'=>$itemname,'itemdesc'=>$itemdesc,'price'=>$price,'quantity'=>$quantity,'catid'=>$catid);
        DB::table('items')->insert($data);
    }
}

