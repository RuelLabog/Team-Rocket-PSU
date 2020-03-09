<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use View;
use App\Subscriber_Admin;
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
       return Subscriber_Admin::all();
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
        $id = $request->input('id');
        $name = $request->input('name');
        $uname = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');

        $updateSubscriber = Subscriber_Admin::findOrFail($id);

        $updateSubscriber->subscriber_name = $name;
        $updateSubscriber->username = $uname;
        $updateSubscriber->email = $email;
        $updateSubscriber->password = $password;

        $updateSubscriber->save();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function delete(Request $request) {
        $id = $request->input('id');
        Subscriber_Admin::find($id)->delete();


    }

    function insert(Request $req)
    {
      $name = $req->input('name');
      $uname = $req->input('username');
      $email = $req->input('email');
      $password = $req->input('password');

      $subscriber = array('subscriber_name'=>$name, 'username'=>$uname, 'email'=>$email, 'password'=>$password, 'subscriber_status'=>'inactive', 'service_id'=>'1');
      Subscriber_Admin::insert($subscriber);
    }
}

