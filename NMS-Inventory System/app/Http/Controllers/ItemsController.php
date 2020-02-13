<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\item;
use App\category;
use App\reducehistory;
use Illuminate\Http\Request;
use DB;
use View;
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
    // public function getData(){
    //     $data['data'] = DB::table('items')
    //                     ->select('quantity')
    //                     ->where('items.deleted_at', '=', null)
    //                     ->get();


    //     if(count($data) > 0){
    //         return view('pages/items_page', $data);
    //     }
    //     else{
    //         return view('pages/items_page');
    //     }
    //    // return Datatables::of($students)->make(true);
    // }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            $data = item::select('items.id', 'itemname', 'itemdesc', 'quantity', 'catname')
                        ->join('categories', 'categories.id', '=', 'items.catid')
                        ->get();

            return DataTables::of($data)
            ->addColumn('quantity', function($data){
                                        $button2 = '<a href="" class="font-weight-bold" data-toggle="modal" data-target="#modal-add-quantity"
                                        id="'.$data->id.'"
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    public function update(Request $request)
    {
        //
        $id = $request->input('eItemID');
        $updateitem = item::findOrFail($id);

        $updateitem->itemname =  $request->input('eItemname');
        $updateitem->itemdesc = $request->input('eItemDesc');
        $updateitem->quantity = $request->input('eQuantity');
        $updateitem->catid = $request->input('catid');



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

        // return back()->with($notification);

        // $id = $request->input('eItemID');
        // $updateitem = item::findOrFail($id);

        // $updateitem->itemname =  $request->input('eItemname');
        // $updateitem->itemdesc = $request->input('eItemDesc');
        // $updateitem->price = $request->input('ePrice');
        // $updateitem->quantity = $request->input('eQuantity');
        // $updateitem->catid = $request->input('catid');



        // if ($request['eCatName'] == NULL || $request['eCatDesc'] == NULL) {
        //     $notification = array(
        //         'message'=> 'Please fill up required fields!',
        //         'alert-type' => 'error'
        //     );

        // }else{
        //     $updateitem->save();
        //     $notification = array(
        //         'message'=> 'Item updated successfully!',
        //         'alert-type' => 'success'
        //     );

        // }

        // return back()->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function updateQuantity(Request $request)
    {
        $itemid = $request->input('rItemID');
        $quantitydec = $request->input('rQuantity');
        $datedec = now();
        $statusreport = $request->input('statReport');
        $userid = auth()->user()->id;
        $item =  array('itemid'=>$itemid,'quantitydec'=>$quantitydec,'datedec'=>$datedec,'statusreport'=>$statusreport,'userid'=>$userid);

        DB::table('dechistory')->insert($item);

        $id = $request->input('rItemID');
        $updateitem = item::findOrFail($id);
        $updateitem->quantity = $request->input('rQuantity');
        $updateitem->save();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

            return back()->with($notification);
    }
}

