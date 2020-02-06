<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class UsersController extends Controller
{
    //Retreiving of Data.
    function getData(){
        $data['data'] = DB::table('users')->get();

        if(count($data) > 0){
            return view('pages/users_page', $data);
        }
        else{
            return view('pages/users_page');
        }
    }


}
