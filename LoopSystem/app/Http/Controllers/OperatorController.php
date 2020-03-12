<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use View;
use App\Operator;
use App\Service;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidateRequests;
use Illuminate\Foundation\Validation\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
use Validator, Input;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{

    // for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Retreiving of Data.
    function getData(){
        return Operator::select('username', 'email', 'user_status', 'service_name', 'users.created_at', 'users.id', 'service_id')
                                ->join('services', 'services.id', '=', 'users.service_id')
                                ->where('user_type', '!=', 'admin')
                                ->orderBy('users.created_at', 'DESC')
                                ->get();
    }

    function getService(){
        return Service::orderBy('service_name','ASC')
                        ->get();
    }


    public function index(Request $request)
    {
        return view('pages.operators');
    }


    public function update(Request $request)
    {
         $id = $request->input('id');
         $pass =  $request->input('password');
        $updateOperator = Operator::findOrFail($id);

        $updateOperator->username = $request->input('username');
        $updateOperator->email = $request->input('email');
        $updateOperator->service_id = $request->input('service');

        if($pass != ""){
            $updateOperator->password = Hash::make($pass);
        }

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
    }

    function insert(Request $req)
    {
        $uname = $req->input('username');
        $email = $req->input('email');
        $pass = Hash::make($req->input('password'));
        $service = $req->input('service');

        $operator = array('username'=>$uname, 'email'=>$email, 'password'=>$pass, 'service_id'=>$service, 'user_type'=>'operator', 'created_at'=>now(), 'user_status'=>'inactive');
        Operator::insert($operator);
    }
}

