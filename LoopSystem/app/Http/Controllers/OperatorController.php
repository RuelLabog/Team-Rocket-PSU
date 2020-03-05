<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use View;
use App\Operator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidateRequests;
use Illuminate\Foundation\Validation\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
use Validator, Input;

class OperatorController extends Controller
{

    // for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Retreiving of Data.
    function getData(){
        return Operator::select('id', 'username', 'user_status', 'email', 'created_at', )
                        ->where('user_type', '!=', 'admin')
                        ->orderBy('created_at', 'DESC')
                        ->get();
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.operators');
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
        $updateOperator = Operator::findOrFail($id);

        $updateOperator->username = $request->input('username');
        $updateOperator->email = $request->input('email');
        $updateOperator->password = $request->input('password');

        $updateOperator->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function delete(Request $req) {
        $id = $req->input('id');
        Operator::find($id)->delete();
        // Operator::where('id', '=', $id)->delete();
        return $id;
    }

    function insert(Request $req)
    {
        $uname = $req->input('username');
        $email = $req->input('email');
        $pass = $req->input('password');

        $operator = array('username'=>$uname, 'created_at'=>now());
        // $operator = array('username'=>$uname, 'email'=>$email, 'password'=>$pass, 'user_status'=>'inactive', 'user_type'=>'operator', 'service_id'=>'1');
        DB::table('users')->insert($operator);

    }
}

