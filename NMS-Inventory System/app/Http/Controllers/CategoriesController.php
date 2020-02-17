<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\category;
use DB;
use Yajra\DataTables\DataTables;
date_default_timezone_set('Asia/Manila');


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
                                    $button = '<span name="edit" id="'.$data->id.'" class="edit table-button cursor-pointer mr-3"
                                    data-catid="'.$data->id.'"
                                    data-catname="'.$data->catname.'"
                                    data-catdesc="'.$data->catdesc.'"
                                    data-toggle="modal" data-target="#modal-edit-category"><a>
                          <i class="fas fa-edit text-danger"></i>
                        </a></span>';
                                    $button .= '<span name="delete" id="'.$data->id.'" class="delete table-button cursor-pointer delete"
                                    data-catname="'.$data->catname.'"
                                    data-catid="'.$data->id.'"
                                    data-toggle="modal" data-target="#modal-delete-category"><a><i class="fas fa-trash text-danger"></i></a></span>';
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

    public function restore(Request $request){
        $catname = $request['catName'];
       DB::table('categories')->where('catname', '=', $catname)->update(['deleted_at' => null]);


    }

    public function forceDelete(Request $request){
        $catname = $request->input('catName');
        DB::table('categories')->where('catname', '=', $catname)->delete();
    }

    public function update(Request $request){
        $id = $request->input('eCatID');
        $updatecat = category::findOrFail($id);
        $updatecat->catname = $request->input('eCatName');
        $updatecat->catdesc = $request->input('eCatDesc');

        if(DB::table('categories')->where('catname', '=', $request->input('eCatName'))->where('deleted_at', '!=', null)->exists()) {
            $button = '<button class="btn-primary btn-xs" id="restoreBtn" value="'.$request->input('eCatName').'" onclick="restore()">Restore</button>';
            $button2 = '<button class="btn-danger btn-xs" id="forcedDelBtn" value="'.$request->input('eCatName').'" onclick="forceDel()">Force Delete</button>';
            return response()->json(['err'=>'Category name already exists but was soft deleted! Do you want to restore or force delete category name '.$request->input('eCatName').' ? &nbsp;&nbsp;&nbsp;'.$button.$button2]);
            // return response()->json(['err'=>'Category name already exists']);
        }elseif(DB::table('categories')->where('catname', '=', $request->input('eCatName'))->where('id', '!=', $id)->exists()) {
            return response()->json(['err'=>'Category name already exists']);
        }else{
            $updatecat->save();
            return response()->json(['success'=>'Successfully Updated']);

        }


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

        if(DB::table('items')->where('catid', '=', $deleteCat)->exists()){
            return response()->json(['err'=>'Sorry, the category cannot be deleted.
            An item exists under this category.']);
        }else{
            category::find($deleteCat)->delete();
            return response()->json(['success'=>'Category deleted successfully!']);
        }
    }

    function insert(Request $req){
        $catname = $req->input('catName');
        $catdesc = $req->input('catDesc');
        $data = array('catname'=>$catname,'catdesc'=>$catdesc,'created_at'=>NOW(),'updated_at'=>NULL,'deleted_at'=>NULL);

        if(DB::table('categories')->where('catname', '=', $catname)->where('deleted_at','=', null)->exists()){
            return response()->json(['err'=>'Category name already exists!']);
            // DB::table('categories')->where('catname', '=', $catname)->delete();
            // DB::table('categories')->insert($data);
            // $notification = array(
            //     'message'=> 'A new category is inserted!',
            //     'alert-type' => 'success'
            // );
        }elseif(DB::table('categories')->where('catname', '=', $catname)->where('deleted_at','!=', null)->exists()){
            $button = '<button class="btn-primary btn-xs" id="restoreBtn" value="'.$catname.'" onclick="restore()">Restore</button>';
            return response()->json(['err'=>'Category name already exists but was soft deleted. Do you want to restore category name '.$catname.'?&nbsp;&nbsp;&nbsp;'.$button]); // $notification = array(
            //     'message'=> 'A new category is inserted!',
            //     'alert-type' => 'success'
            // );
        }else{
            DB::table('categories')->insert($data);
            return response()->json(['success'=>'Successfully Added']);
            // $notification = array(
            //     'message'=> 'An error occured while adding category.',
            //     'alert-type' => 'error'
            // );
        }
        // return back()->with($notification);
    }
}
