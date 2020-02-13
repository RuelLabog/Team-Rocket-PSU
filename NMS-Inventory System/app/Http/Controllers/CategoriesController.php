<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\category;
use DB;
use Yajra\DataTables\DataTables;

class CategoriesController extends Controller
{
    //for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = category::orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                                ->addColumn('action', function($data){
                                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"
                                    data-catid="'.$data->id.'"
                                    data-catname="'.$data->catname.'"
                                    data-catdesc="'.$data->catdesc.'"
                                    data-toggle="modal" data-target="#modal-edit-category">Edit</button>';
                                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"
                                    data-catname="'.$data->catname.'"
                                    data-catid="'.$data->id.'"
                                    data-toggle="modal" data-target="#modal-delete-category">Delete</button>';
                                    return $button;
                                })
                                // ->rawColums(['action'])
                                ->make(true);

        }
        return view('pages/categories_page');
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

    public function update(Request $request){
        $id = $request->input('eCatID');
        $updatecat = category::findOrFail($id);
        $updatecat->catname = $request->input('eCatName');
        $updatecat->catdesc = $request->input('eCatDesc');
        $updatecat->save();

        if ($request['eCatName'] == NULL || $request['eCatDesc'] == NULL) {
            $notification = array(
                'message'=> 'Please fill up required fields!',
                'alert-type' => 'error'
            );

        }else{
            $updatecat->save();
            $notification = array(
                'message'=> 'Item updated successfully!',
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
    public function delete(Request $request)
    {
        $deleteCat = $request->input('dCatID');


        if (category::find($deleteCat)->delete()) {
            $notification = array(
                'message'=> 'Category deleted successfully!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message'=> 'An error occured while deleting the category!',
                'alert-type' => 'error'
            );
        }
        return back()->with($notification);
    }

    function insert(Request $req){
        $catname = $req->input('catName');
        $catdesc = $req->input('catDesc');
        $data = array('catname'=>$catname,'catdesc'=>$catdesc,'created_at'=>NOW(),'updated_at'=>NULL,'deleted_at'=>NULL);

        if(DB::table('categories')->where('catname', '=', $catname)->exists()){
            DB::table('categories')->where('catname', '=', $catname)->delete();
            DB::table('categories')->insert($data);
            $notification = array(
                'message'=> 'A new category is inserted!',
                'alert-type' => 'success'
            );
        }elseif(DB::table('categories')->insert($data)){

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
        return back()->with($notification);
    }
}
