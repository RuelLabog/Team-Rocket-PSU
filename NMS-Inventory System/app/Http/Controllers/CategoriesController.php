<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\category;


class CategoriesController extends Controller
{
    //for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }


    //
    function getData(){
        $data['data'] = DB::table('categories')->get()
                    ->where('deleted_at', '=', null);


        if(count($data) > 0){
            return view('pages/categories_page', $data);
        }
        else{
            return view('pages/categories_page');
        }
    }

    function destroy(Request $request)
    {
        $deleteCat = $request->input('dCatID');
        category::find($deleteCat)->delete();
        return Redirect::back();


    }
}
