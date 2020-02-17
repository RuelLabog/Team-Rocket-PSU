<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\item;
use App\category;
use App\reducehistory;
use App\transaction;
use Illuminate\Http\Request;
use DB;
use View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidateRequests;
use Illuminate\Foundation\Validation\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
use Validator, Input;
use Yajra\DataTables\DataTables;
date_default_timezone_set('Asia/Manila');

class ItemsController extends Controller
{

    // for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $data = item::select('items.id', 'itemname', 'itemdesc', 'quantity', 'catname')
                        ->join('categories', 'categories.id', '=', 'items.catid')
                        ->get();

            return DataTables::of($data)
            ->addColumn('quantity', function($data){
                    $button2 = '<a href="" class="font-weight-bold" data-toggle="modal" data-target="#modal-increase-quantity"
                    id="'.$data->id.'"
                    data-itemid="'.$data->id.'"
                    data-quantity="'.$data->quantity.'"
                    style="margin-left:10%; margin-right:10%;">
                    <i class="fas fa-plus-square text-success"></i>
                    </a>
                    '.$data->quantity.'
                    <a href="" class="font-weight-bold" data-toggle="modal" data-target="#modal-reduce-quantity"
                    id="'.$data->id.'"
                    data-itemid="'.$data->id.'"
                    data-quantity="'.$data->quantity.'"
                    style="margin-left:10%; margin-right:10%;">
                    <i class="fas fa-minus-square text-danger"></i>
                    </a>';
                    return $button2;
            })
            ->addColumn('action', function($data){
                    $button = '<span class="table-button cursor-pointer mr-3" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"
                    <span class="table-button cursor-pointer mr-3"
                    data-itemname="'.$data->itemname.'"
                    data-itemdesc="'.$data->itemdesc.'"
                    data-quantity="'.$data->quantity.'"
                    data-itemid="'.$data->id.'"
                    data-catid="'.$data->catid.'"
                    data-toggle="modal" data-target="#modal-edit-items"><a>
                    <i class="fas fa-edit text-danger"></i>
                    </a></span>';

                    $button .= '<span class="table-button cursor-pointer delete" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"
                    data-itemid="'.$data->id.'"
                    data-itemname="'.$data->itemname.'"
                    data-toggle="modal" data-target="#modal-delete-items"><a><i class="fas fa-trash text-danger"></i></a></span>';

                    return $button;
            })
                    ->rawColumns(['quantity','action'])
                    ->make(true);
        }
        return view('pages/items_page');
    }

    public function edit(Request $request)
    {
        $eItemID = $request->input('eItemID');
        $data = item::join('categories', 'categories.id', '=', 'items.catid')->findOrFail($eItemID);
        return response()->json(['result' => $data]);
    }

    public function update(Request $request)
    {
        $id = $request->input('eItemID');
        $updateitem = item::findOrFail($id);

        $updateitem->itemname =  $request->input('eItemname');
        $updateitem->itemdesc = $request->input('eItemDesc');
        $updateitem->quantity = $request->input('eQuantity');
        $updateitem->catid = $request->input('catid');

        if(DB::table('items')->where('itemname', '=', $request->input('eItemname'))->where('deleted_at','!=', null)->exists()){
            $button = '<button class="btn-primary btn-xs" id="restoreBtn" value="'.$request->input('eItemname').'" onclick="restore()">Restore</button>';
            $button2 = '<button class="btn-danger btn-xs" id="forcedDelBtn" value="'.$request->input('eItemname').'" onclick="forceDel()">Force Delete</button>';
            return response()->json(['err'=>'Itemname name already exists but was soft deleted. Do you want to restore item name '.$request->input('eItemname').' ? &nbsp;&nbsp;&nbsp;'.$button.$button2]);
        }elseif(DB::table('items')->where('itemname', '=', $request->input('eItemname'))->where('id', '!=', $id)->exists()) {
            return response()->json(['err'=>$request->input('eItemname').' already exists!']);
        }else{
            $updateitem->save();
            return response()->json(['success'=>'Successfully updated!']);
        }
    }

    public function restore(Request $request)
    {
        $itemname = $request['itemname'];
        DB::table('items')->where('itemname', '=', $itemname)->update(['deleted_at' => null]);
    }

    public function forceDelete(Request $request)
    {
        $itemname = $request->input('itemname');
        DB::table('items')->where('itemname', '=', $itemname)->delete();
    }

    public function updateQuantity(Request $request)
    {
        $itemid = $request->input('rItemID');
        $quantitydec = $request->input('rQuantity');
        $quantity = DB::table('items')->where('id',$itemid)->value('quantity');
        $total = $quantity-$quantitydec;
        $datedec = now();
        $statusreport = $request->input('statReport');
        $userid = auth()->user()->id;
        $item =  array('itemid'=>$itemid,'quantitydec'=>$total ,'datedec'=>$datedec,'statusreport'=>$statusreport,'userid'=>$userid);
        DB::table('dechistory')->insert($item);

        $id = $request->input('rItemID');
        $updateitem = item::findOrFail($id);
        $updateitem->quantity = $request->input('rQuantity');
        $updateitem->save();
    }

    public function increaseQuantity(Request $request)
    {
        $itemid = $request->input('iItemID');
        $ornum = $request->input('iOrnum');
        $quantityinc = $request->input('iQuantity');
        $quantity = DB::table('items')->where('id',$itemid)->value('quantity');
        $total = $quantityinc-$quantity;
        $dept = $request->input('iDept');
        $itemInc =  array('itemid'=>$itemid,'transid'=>$ornum,'quantity'=>$total,'department'=>$dept);

        DB::table('transactions')->insert($itemInc);

        $id = $request->input('iItemID');
        $updateitem = item::findOrFail($id);
        $updateitem->quantity = $request->input('iQuantity');
        $updateitem->save();
    }

    public function delete(Request $request) {
        $deleteitem = $request->input('dItemID');

        if (item::find($deleteitem)->delete()) {
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

        if (DB::table('items')->where('itemname', '=', $itemname)->where('deleted_at','=', null)->exists()) {
            return response()->json(['err'=>$itemname.' already exists!']);
        }
        elseif (DB::table('items')->where('itemname', '=', $itemname)->where('deleted_at','!=', null)->exists()) {
            $button = '<button class="btn-primary btn-xs" id="restoreBtn" value="'.$itemname.'" onclick="restore()">Restore</button>';
            return response()->json(['err'=>'Item name already exists but was soft deleted. Do you want to restore item name '.$itemname.'?&nbsp;&nbsp;&nbsp;'.$button]);
        }
        else{
            DB::table('items')->insert($item);
            return response()->json(['success'=>'Successfully Added']);
        }
    }
}

