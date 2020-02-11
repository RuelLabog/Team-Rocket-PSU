<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

        //Retreiving of Data.
    function getData(){
        $data['data'] = DB::table('users')->get()
                        ->where('id', '=', auth()->user()->id);


        if(count($data) > 0){
            return view('pages/profile_page', $data);
        }
        else{
            return view('pages/profile_page');
        }
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

         //
        $updateprofile = user::findOrFail(auth()->user()->id);

        $updateprofile->username =  $request['username'];
        $updateprofile->email = $request['email'];
        $updateprofile->fname = $request['fname'];
        $updateprofile->lname = $request['lname'];
        $updateprofile->password = Hash::make($request['password']);

        $password = DB::table('users')->where('id', auth()->user()->id)->value('password');
        
        if(Hash::make($request['password']) != $password){
            $notification = array(
                'message'=> 'Invalid Password!'.Hash::make($request['password']).' is not equal to '.  $password,
                'alert-type' => 'error'
            );
        }elseif ($request['username'] == NULL || $request['email'] == NULL || $request['fname'] == NULL || $request['lname'] == NULL) {
            $notification = array(
                'message'=> 'Please fill up required fields!',
                'alert-type' => 'error'
            );
            
        }else{
            $updateprofile->save();
            $notification = array(
                'message'=> 'Profile updated successfully!',
                'alert-type' => 'success'
            );

        }

        return back()->with($notification);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
