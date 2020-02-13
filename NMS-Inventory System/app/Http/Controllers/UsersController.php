<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\item;
use App\category;
use App\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
class UsersController extends Controller
{

    // for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Retreiving of Data.
    function getData(){
        $data['data'] = DB::table('users')
                     ->where('deleted_at', '=', null)
                     ->get();


        if(count($data) > 0){
            return view('pages/users_page', $data);
        }
        else{
            return view('pages/users_page');
        }
    }




        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if($request->ajax()){
            $data = User::latest()->where('usertype', '=', 'admin')->get();
            return DataTables::of($data)
                                ->addColumn('name', function($data){
                                    $name= $data->fname." ".$data->lname;
                                    return $name;
                                })
                                ->addColumn('action', function($data){
                                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"
                                    data-userid="'.$data->id.'"
                                    data-username="'.$data->username.'"
                                    data-fname="'.$data->fname.'"
                                    data-lname="'.$data->lname.'"
                                    data-email="'.$data->email.'"
                                    data-password="'.$data->password.'"
                                    data-toggle="modal" data-target="#modal-edit-user">Edit</button>';
                                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"
                                    data-fname="'.$data->fname.'"
                                    data-lname="'.$data->lname.'"
                                    data-userid="'.$data->id.'"
                                    data-toggle="modal" data-target="#modal-delete-user">Delete</button>';
                                    return $button;
                                })
                                // ->rawColums(['action'])
                                ->make(true);

        }
        return view('pages/users_page');
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

    public function update(Request $request)
    {
        //
        $updateUser = User::findOrFail($request->input('eID'));

        $updateUser->username =  $request->input('eUsername');
        $updateUser->email = $request->input('eEmail');
        $updateUser->fname = $request->input('eFirstName');
        $updateUser->lname = $request->input('eLastName');
        $updateUser->password = Hash::make($request->input('ePassword'));

        $emailValidation="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";

        if(!preg_match($emailValidation, $request->input('eEmail'))){
            return response()->json(['errEmail'=>'Email is invalid']);
        }
        if($request->input('ePassword') != $request->input('eConfPassword')){
            return response()->json(['errPass'=>'Passwords did not match']);
        }
        if(strlen($request->input('ePassword')) < 8){
            return response()->json(['errPassWeak'=>'Password is weak']);
        }

        if(DB::table('users')->where('email', '=', $request->input('eEmail'))->where('id', '!=', $request->input('eID'))->exists()){
            return response()->json(['errEmail'=>'Email exists']);
        }else{
            $updateUser->save();
            return response()->json(['success'=>'Successfully updated']);
        }




        // return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        $deleteUser = $request->input('dID');
        User::find($deleteUser)->delete();
        return back();
    }

    public function insert(Request $request){
        $name = "/^[A-Z][a-z A-Z ]+$/";
        $emailValidation="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
        $number="/^[0-9]+$/";



        $username = $request->input('username');
        $email = $request->input('email');
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $password = $request->input('password');
        $confPassword = $request->input('confPassword');
        $img = "";

        if(strlen($password) < 8){
            return response()->json(['errPassWeak'=>'Password is weak']);
        }
        if($password != $confPassword){
            return response()->json(['errPass' => 'Passwords did not match!']);
        }

        if(!preg_match($emailValidation, $email)){
            return response()->json(['errEmail' => 'Email is invalid! Please re-enter your email']);
        }




        $user = array('username'=>$username, 'email'=>$email, 'fname'=>$fname, 'lname'=>$lname, 'password'=>Hash::make($password), 'usertype'=>'admin', 'image'=>'default.png', 'created_at'=> NOW());
        if(DB::table('users')->where('email', '=', $email)->exists()){
            return response()->json(['errEmail'=>'Email Exists!']);
        }else{
            User::insert($user);
            return response()->json(['success'=>'Successfully Inserted!']);
        }

        User::insert($user);


    }






}
