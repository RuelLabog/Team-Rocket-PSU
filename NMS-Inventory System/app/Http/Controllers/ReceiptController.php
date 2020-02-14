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
                                    $button = '<span name="edit" id="'.$data->id.'" class="edit table-button cursor-pointer mr-3"
                                    data-recid="'.$data->id.'"
                                    data-ornum="'.$data->ornum.'"
                                    data-pdate="'.$data->pdate.'"
                                    data-supplier="'.$data->supplier.'"
                                    data-toggle="modal" data-target="#modal-edit-receipt"><a>
                          <i class="fas fa-edit text-danger"></i>
                        </a></span>';
                                    $button .= '<span class="table-button cursor-pointer delete" name="delete" id="'.$data->id.'"
                                    data-recid="'.$data->id.'"
                                    data-ornum="'.$data->ornum.'"
                                    data-toggle="modal" data-target="#modal-delete-receipt"><a><i class="fas fa-trash text-danger"></i></a></span>';
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

    public function restore(Request $request){
        $ornum = $request['ornum'];
       DB::table('receipts')->where('ornum', '=', $ornum)->update(['deleted_at' => null]);
    }

    public function forceDelete(Request $request){
        $ornum = $request->input('ornum');
        DB::table('receipts')->where('ornum', '=', $ornum)->delete();
    }

    public function update(Request $request){
        $id = $request->input('eRecID');
        $updaterec = receipt::findOrFail($id);
        $updaterec->ornum =  $request->input('eOrnum');
        $updaterec->supplier = $request->input('eSupplier');
        $updaterec->pdate = $request->input('ePdate');
        

        if(DB::table('receipts')->where('ornum', '=', $request->input('eOrnum'))->where('deleted_at', '!=', null)->exists()) {
            $button = '<button class="btn-primary btn-xs" id="restoreBtn" value="'.$request->input('eOrnum').'" onclick="restore()">Restore</button>';
            $button2 = '<button class="btn-danger btn-xs" id="forcedDelBtn" value="'.$request->input('eOrnum').'" onclick="forceDel()">Force Delete</button>';
            return response()->json(['err'=>'Receipt name already exists but was soft deleted! Do you want to restore or force delete receipt '.$request->input('eOrnum').' ? &nbsp;&nbsp;&nbsp;'.$button.$button2]);
            // return response()->json(['err'=>'Category name already exists']);
        }elseif(DB::table('receipts')->where('ornum', '=', $request->input('eOrnum'))->where('id', '!=', $id)->exists()) {
            return response()->json(['err'=>'Receipt name already exists']);
        }else{
            $updaterec->save();
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
