<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\receipt;
use DB;
use Yajra\DataTables\DataTables;

class ReceiptController extends Controller
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
            $data = receipt::latest()->get();
            return DataTables::of($data)
                                ->addColumn('action', function($data){
                                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"
                                    data-recid="'.$data->id.'"
                                    data-ornum="'.$data->ornum.'"
                                    data-pdate="'.$data->pdate.'"
                                    data-supplier="'.$data->supplier.'"
                                    data-toggle="modal" data-target="#modal-edit-receipt">Edit</button>';
                                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"
                                    data-recid="'.$data->id.'"
                                    data-ornum="'.$data->ornum.'"
                                    data-toggle="modal" data-target="#modal-delete-receipt">Delete</button>';
                                    return $button;
                                })
                                // ->rawColums(['action'])
                                ->make(true);
        }
        return view('pages/receipts_page');
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
        $id = $request->input('eRecID');
        $updaterec = receipt::findOrFail($id);
        $updaterec->ornum =  $request->input('eOrnum');
        $updaterec->supplier = $request->input('eSupplier');
        $updaterec->pdate = $request->input('ePdate');
        $updaterec->save();

        if ($request['eOrnum'] == NULL || $request['eSupplier'] == NULL || $request['ePdate'] == NULL) {
            $notification = array(
                'message'=> 'Please fill up required fields!',
                'alert-type' => 'error'
            );
        }else{
            $updaterec->save();
            $notification = array(
                'message'=> 'Item updated successfully!',
                'alert-type' => 'success'
            );}
            
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $deleteRec = $request->input('dRecID');
        if (receipt::find($deleteRec)->delete()) {
            $notification = array(
                'message'=> 'Receipt deleted successfully!',
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
        $ornum = $req->input('ornum');
        $supplier = $req->input('supplier');
        $pdate = $req->input('pdate');
        $data = array('ornum'=>$ornum,'supplier'=>$supplier, 'pdate'=>$pdate,'created_at'=>NOW(),'updated_at'=>NULL,'deleted_at'=>NULL);

        if(DB::table('receipts')->where('ornum', '=', $ornum)->exists()){
            DB::table('receipts')->where('ornum', '=', $ornum)->delete();
            DB::table('receipts')->insert($data);
            $notification = array(
                'message'=> 'A new category is inserted!',
                'alert-type' => 'success'
            );
        }elseif(DB::table('receipts')->insert($data)){
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
