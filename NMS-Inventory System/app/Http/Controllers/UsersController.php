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
<<<<<<< HEAD
    function getData(){
        // $data['data'] = DB::table('users')
        //              ->where('deleted_at', '=', null)
        //              ->get();


        // if(count($data) > 0){
        //     return view('pages/users_page', $data);
        // }
        // else{
            // return view('pages/users_page');
        // }
    }
=======
    // function getData(){
    //     $data['data'] = DB::table('users')
    //                  ->where('deleted_at', '=', null)
    //                  ->get();


    //     if(count($data) > 0){
    //         return view('pages/users_page', $data);
    //     }
    //     else{
    //         return view('pages/users_page');
    //     }
    // }
>>>>>>> eea553088b9d7bb791224fedd5020b0c8237ab10




        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if($request->ajax()){
<<<<<<< HEAD
            $data = User::latest()->where('usertype', '=', 'admin')->get();
            return DataTables::of($data)
                                ->addColumn('name', function($data){
                                    $name= $data->fname." ".$data->lname;
                                    return $name;
                                })
                                ->addColumn('created_at', function($data){
                                    $date = '<span style="cursor:context-menu" title="'.date_format($data->created_at,"l, F d, Y H:i:s A").'">'.$data->created_at.'</span>';
                                    return $date;
                                })
                                ->addColumn('action', function($data){
                                    $button = '<span name="edit" id="'.$data->id.'" class="edit table-button cursor-pointer mr-3"
                                    data-userid="'.$data->id.'"
=======
            $data = User::get();
            return DataTables::of($data)
                                ->addColumn('name', function($data){
                                   $name= $data->fname." ".$data->lname;
                                   return $name;
                                })
                                ->addColumn('action', function($data){
                                    $button = ' <span class="table-button cursor-pointer mr-3"
                                    data-id="'.$data->id.'"
>>>>>>> eea553088b9d7bb791224fedd5020b0c8237ab10
                                    data-username="'.$data->username.'"
                                    data-email="'.$data->email.'"
                                    data-fname="'.$data->fname.'"
                                    data-lname="'.$data->lname.'"
                                    data-password="'.$data->password.'"
                                    data-toggle="modal" data-target="#modal-edit-user">
                                      <a>
                                        <i class="fas fa-edit text-danger"></i>
                                      </a>
                                    </span>';
                                    $button .= '  <span class="table-button cursor-pointer"
                                    data-id="'.$data->id.'"
                                    data-fname="'.$data->fname.'"
                                    data-lname="'.$data->lname.'"
<<<<<<< HEAD
                                    data-email="'.$data->email.'"
                                    data-password="'.$data->password.'"
                                    data-toggle="modal" data-target="#modal-edit-user"><a>
                          <i class="fas fa-edit text-danger"></i>
                        </a></span>';
                                    $button .= '<span class="table-button cursor-pointer delete" name="delete" id="'.$data->id.'"
                                    data-fname="'.$data->fname.'"
                                    data-lname="'.$data->lname.'"
                                    data-userid="'.$data->id.'"
                                    data-toggle="modal" data-target="#modal-delete-user"><a><i class="fas fa-trash text-danger"></i></a></span>';
=======
                                    data-toggle="modal" data-target="#modal-delete-user">
                                    <a>
                                      <i class="fas fa-trash text-danger"></i>
                                    </a>
                                  </span>';
>>>>>>> eea553088b9d7bb791224fedd5020b0c8237ab10
                                    return $button;
                                })
                                ->rawColumns(['action', 'created_at'])
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
<<<<<<< HEAD
        $updateUser = User::findOrFail($request->input('eID'));

        $updateUser->username =  $request->input('eUsername');
        $updateUser->email = $request->input('eEmail');
        $updateUser->fname = $request->input('eFirstName');
        $updateUser->lname = $request->input('eLastName');
        $updateUser->password = Hash::make($request->input('ePassword'));
=======

        $id = $request->input('eUserID');
        $updateUser = User::findOrFail($id);

        $updateUser->username =  $request->input('eUserName');
        $updateUser->email = $request->input('eEmail');
        $updateUser->fname = $request->input('eFirstName');
        $updateUser->lname =$request->input('eLastName');
        $updateUser->password = Hash::make($request['ePassword']);
>>>>>>> eea553088b9d7bb791224fedd5020b0c8237ab10

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

        $deleteUser = $request->input('dUserID');
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


    public function insert(Request $request){
        $username = $request->input('userName');
        $email = $request->input('email');
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $password = $request->input('password');
        $confPassword = $request->input('confPassword');
        $img = '';


        $data = array('username'=>$username,'email'=>$email,'fname'=>$fname, 'lname'=>$lname, 'password'=>$confPassword,'usertype'=>'Admin','image'=>$img,'created_at'=>NOW(),'updated_at'=>NULL,'deleted_at'=>NULL);

        if(DB::table('users')->where('email', '=', $email)->exists()){
            // DB::table('u')->where('catname', '=', $catname)->delete();
            // DB::table('categories')->insert($data);
            // $notification = array(
            //     'message'=> 'A new category is inserted!',
            //     'alert-type' => 'success'
            // );
        }elseif(DB::table('users')->insert($data)){

            $notification = array(
                'message'=> 'A new category is inserted!',
                'alert-type' => 'success'
            );

        }else{
            $notification = array(
                'message'=> 'An error occured while adding category.',
                'alert-type' => 'error'
            );
        }
        return back();



    }
    }

