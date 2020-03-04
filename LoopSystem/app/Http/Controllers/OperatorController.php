<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use View;
use App\Operator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidateRequests;
use Illuminate\Foundation\Validation\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
use Validator, Input;

class OperatorController extends Controller
{

    // for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Retreiving of Data.
    function getData(){
        return Operator::select('id', 'username', 'user_status', 'email', 'created_at', )
                        ->where('user_type', '!=', 'admin')
                        ->orderBy('created_at', 'DESC')
                        ->get();
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.operators');
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
        $id = $request->input('id');
        $updateOperator = Operator::findOrFail($id);

        $updateOperator->username = $request->input('username');
        $updateOperator->email = $request->input('email');
        $updateOperator->password = $request->input('password');

        // $updateOperator->save();
        //
        // $id = $request->input('eItemID');
        // $updateitem = item::findOrFail($id);

        // $updateitem->itemname =  $request->input('eItemname');
        // $updateitem->itemdesc = $request->input('eItemDesc');
        // $updateitem->quantity = $request->input('eQuantity');
        // $updateitem->catid = $request->input('catid');



        // if ($request['eItemname'] == NULL || $request['eItemDesc'] == NULL || $request['eQuantity'] == NULL) {
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


    public function delete(Request $req) {

        return $id = $req->input('id');
       Operator::find($id)->delete();
        // DB::table('users')->where('id', '=', $id);
        // $deleteitem = $request->input('dItemID');


        // if (item::find($deleteitem)->delete()) {
        //     $notification = array(
        //         'message'=> 'Item deleted successfully!',
        //         'alert-type' => 'success'
        //     );
        // }else{
        //     $notification = array(
        //         'message'=> 'An error occured while deleting the item!',
        //         'alert-type' => 'error'
        //     );
        // }

        // return back()->with($notification);

    }

    function insert(Request $req)
    {
        $uname = $req->input('oUsername');
        $email = $req->input('oEmail');
        $pass = $req->input('oPassword');

        // $operator = array('username'=>$uname);
        $operator = array('username'=>$uname, 'email'=>$email, 'password'=>$pass, 'user_status'=>'inactive', 'user_type'=>'operator', 'service_id'=>1);
        DB::table('users')->insert($operator);

    }
}

