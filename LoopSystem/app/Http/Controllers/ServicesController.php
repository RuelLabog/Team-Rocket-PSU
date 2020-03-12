<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use View;
use App\Service;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidateRequests;
use Illuminate\Foundation\Validation\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
use Validator, Input;

class ServicesController extends Controller
{

    // for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Retreiving of Data.
    function getData(){
        // return Service::select('id', 'service_name', 'service_status', 'date_created')
        //                 ->where('created_at', '!=', null)
        //                 ->orderBy('created_at', 'DESC')
        //                 ->get();
        return Service::orderBy('created_at', 'DESC')->get();

    }

    function updateStatus(Request $req){
        $id = $req->input('id');
        $status = $req->input('status');
        $updateStatus = Service::findOrFail($id);

        if($status == 'inactive'){
            $updateStatus->service_status = 'active';
        }else{
            $updateStatus->service_status = 'inactive';
        }


        $updateStatus->save();
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.services');
    }




    public function update(Request $req)
    {
        $id = $req->input('id');
        $updateService = Service::findOrFail($id);


        $updateService->service_name = $req->input('serviceName');
        $updateService->updated_at = now();
        $updateService->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function delete(Request $req) {

        $id = $req->input('id');
        Service::where('id', '=', $id)->delete();


    }

    function insert(Request $req)
    {
        $serviceName = $req->input('serviceName');
        $service = array('service_name'=>$serviceName, 'service_status'=>'active');

        DB::table('services')->insert($service);
    }
}

