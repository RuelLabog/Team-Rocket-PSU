<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\item;
use App\Items;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidateRequests;
use Illuminate\Foundation\Validation\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;

class ItemsController extends Controller
{

    // for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Retreiving of Data.
    function getData(){
        $data['data'] = DB::table('items')->get()
                        ->where('deleted_at', '=', null);


        if(count($data) > 0){
            return view('pages/items_page', $data);
        }
        else{
            return view('pages/items_page');
        }
    }




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
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $deleteItem = $request->input('ditemID');
        Items::find($deleteItem)->delete();
        // DB::table('items')->delete($deleteItem);
        return Redirect::back();
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

