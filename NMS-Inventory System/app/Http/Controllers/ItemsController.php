<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\item;
use App\category;
use Illuminate\Http\Request;
use DB;
use View;
use App\Items;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidateRequests;
use Illuminate\Foundation\Validation\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
use Validator, Input; 
use Yajra\DataTables\DataTables;

class ItemsController extends Controller
{

    // for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Retreiving of Data.
    function getData(){
        $data['data'] = DB::table('items')
                        ->select('items.id', 'itemname', 'itemdesc', 'quantity', 'items.deleted_at', 'catname', 'catid')
                        ->join('categories', 'categories.id', '=', 'items.catid')
                        ->where('items.deleted_at', '=', null)
                        ->get();


        if(count($data) > 0){
            return view('pages/items_page', $data);
        }
        else{
            return view('pages/items_page');
        }
       // return Datatables::of($students)->make(true);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = item::latest()->get();
            return DataTables::of($data)
                                ->addColumn('action', function($data){
                                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"
                                    data-itemid="'.$data->id.'"
                                    data-itemname="'.$data->itemname.'"
                                    data-itemdesc="'.$data->itemdesc.'"
                                    data-quantity="'.$data->quantity.'"
                                    data-catid="'.$data->catid.'"
                                    data-toggle="modal" data-target="#modal-edit-item">Edit</button>';
                                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"
                                    data-itemid="'.$data->id.'"
                                    data-itemname="'.$data->itemname.'"
                                    data-toggle="modal" data-target="#modal-delete-item">Delete</button>';
                                    return $button;
                                })
                                // ->rawColums(['action'])
                                ->make(true);
        }
        return view('pages/items_page');
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
    public function edit(Request $request)
    {
        $eItemID = $request->input('eItemID');

        $data = item::join('categories', 'categories.id', '=', 'items.catid')->findOrFail($eItemID);

        return response()->json(['result' => $data]);
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
        $updateitem = item::findOrFail($request->editid);

        $updateitem->itemname =  $request['eItemname'];
        $updateitem->itemdesc = $request['eItemDesc'];
        $updateitem->quantity = $request['eQuantity'];
        $updateitem->catid = $request['catid'];



        if ($request['eItemname'] == NULL || $request['eItemDesc'] == NULL || $request['eQuantity'] == NULL) {
            $notification = array(
                'message'=> 'Please fill up required fields!',
                'alert-type' => 'error'
            );

        }else{
            $updateitem->save();
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
    public function destroy(Request $request) {
        $deleteItem = $request->input('dItemID');
        // item::find($deleteItem)->delete();
        // DB::table('items')->delete($deleteItem);
        //return Redirect::back();

        if (item::find($deleteItem)->delete()) {
            $notification = array(
                'message'=> 'Item deleted successfully!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message'=> 'An error occured while deleting the item!',
                'alert-type' => 'error'
            );
        }
    return back()->with($notification);
    }

    function insert(Request $req)
    {          
                $itemname = $req->input('itemname');
                $itemdesc = $req->input('itemdesc');
                $quantity = $req->input('quantity');
                $catid = $req->input('catid');
                $item =  array('itemname'=>$itemname,'itemdesc'=>$itemdesc,'quantity'=>$quantity,'catid'=>$catid,'created_at'=>NOW(),'updated_at'=>NULL,'deleted_at'=>NULL);

                if (DB::table('items')->where('itemname', '=', $itemname)->exists()) {
                    DB::table('items')->where('itemname', '=', $itemname)->delete();
                    DB::table('items')->insert($item);
                    $notification = array(
                        'message'=> 'A New Item is Inserted!',
                        'alert-type' => 'success'
                    );
                }else{
                    DB::table('items')->insert($item);
                    $notification = array(
                        'message'=> 'A New Item is Inserted!',
                        'alert-type' => 'success'
                    );
                }
                return back()-> with($notification);
    }
}

