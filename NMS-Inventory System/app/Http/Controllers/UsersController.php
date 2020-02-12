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
            $data = User::latest()->get();
            return DataTables::of($data)
                                ->addColumn('action', function($data){
                                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"
                                    data-userid="'.$data->id.'"
                                    data-username="'.$data->username.'"
                                    data-fname="'.$data->fname.'"
                                    data-toggle="modal" data-target="#modal-edit-category">Edit</button>';
                                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"
                                    data-username="'.$data->catname.'"
                                    data-userid="'.$data->id.'"
                                    data-toggle="modal" data-target="#modal-delete-category">Delete</button>';
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
        $updateUser = User::findOrFail($request->eID);

        $updateUser->username =  $request['eUsername'];
        $updateUser->email = $request['eEmail'];
        $updateUser->fname = $request['eFirstName'];
        $updateUser->lname = $request['eLastName'];
        $updateUser->password = Hash::make($request['ePassword']);

        $updateUser->save();

        return back();
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






}
