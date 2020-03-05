<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use View;
use App\Subscriber;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidateRequests;
use Illuminate\Foundation\Validation\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
use Validator, Input;

class Subscriber_AdminController extends Controller
{

    // for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Retreiving of Data.
    function getData(){
       return Subscriber::all();
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages/subscribers');
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
    public function edit(Request $request)
    {
        $eItemID = $request->input('eItemID');

        $data = item::join('categories', 'categories.id', '=', 'items.catid')->findOrFail($eItemID);

        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    public function update(Request $request)
    {
        //
        $id = $request->input('eItemID');
        $updateitem = item::findOrFail($id);

        $updateitem->itemname =  $request->input('eItemname');
        $updateitem->itemdesc = $request->input('eItemDesc');
        $updateitem->quantity = $request->input('eQuantity');
        $updateitem->catid = $request->input('catid');



        if ($request['eItemname'] == NULL || $request['eItemDesc'] == NULL || $request['eQuantity'] == NULL) {
            $notification = array(
                'message'=> 'Please fill up required fields!',
                'alert-type' => 'error'
            );

        }else{
            $updateitem->save();
            $notification = array(
                'message'=> 'Item updated successfully!',
                'alert-type' => 'success'
            );

        }

        // return back()->with($notification);

        // $id = $request->input('eItemID');
        // $updateitem = item::findOrFail($id);

        // $updateitem->itemname =  $request->input('eItemname');
        // $updateitem->itemdesc = $request->input('eItemDesc');
        // $updateitem->price = $request->input('ePrice');
        // $updateitem->quantity = $request->input('eQuantity');
        // $updateitem->catid = $request->input('catid');



        // if ($request['eCatName'] == NULL || $request['eCatDesc'] == NULL) {
        //     $notification = array(
        //         'message'=> 'Please fill up required fields!',
        //         'alert-type' => 'error'
        //     );

        // }else{
        //     $updateitem->save();
        //     $notification = array(
        //         'message'=> 'Item updated successfully!',
        //         'alert-type' => 'success'
        //     );

        // }

        // return back()->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function delete(Request $request) {

        $deleteitem = $request->input('dItemID');


        if (item::find($deleteitem)->delete()) {
            $notification = array(
                'message'=> 'Item deleted successfully!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message'=> 'An error occured while deleting the item!',
                'alert-type' => 'error'
            );
        }

        return back()->with($notification);

    }

    function insert(Request $req)
    {
      $name = $req->input('name');
      $uname = $req->input('username');
      $email = $req->input('email');
      $password = $req->input('password');

      $subscriber = array('subscriber_name'=>$name, 'username'=>$uname, 'email'=>$email, 'password'=>$password, 'subscriber_status'=>'inactive', 'service_id'=>'1');
      Subscriber::insert($subscriber);
    }
}

