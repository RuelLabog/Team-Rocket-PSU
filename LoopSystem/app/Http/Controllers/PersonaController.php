<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use View;
use App\Persona;
use App\Service;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidateRequests;
use Illuminate\Foundation\Validation\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
use Validator, Input;

class PersonaController extends Controller
{

    // for authentication
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //Retreiving of Data.
    function getData(){
        return Persona::join('services', 'personas.service_id', '=', 'services.id')
                        ->select('personas.*', 'services.service_name')
                        ->distinct('$service_name')
                        ->get();
        // return Persona::all();
        // ->join('services', 'services.id', '=', 'personas.service_id')
    }

    function getServiceData(request $request){
        // $id = $request->input('id');
        // $updatePersona = Persona::findOrFail($id);
        // return Persona::join('services', 'personas.service_id', '=', 'services.id')
        //                 ->where('personas.id','=',$updatePersona)
        //                 ->select('services.service_name')
        //                 ->get();
        //  $id = $request->input('id');
        // return Persona::join('services', 'personas.service_id', '=', 'services.id')
        //                 ->select('personas.*', 'services.service_name')
        //                 ->where('personas.id','=', $id)
        //                 ->select('services.service_name')
        //                 ->get();

        // ->join('services', 'services.id', '=', 'personas.service_id')

        $states = DB::table("personas")
                    ->join('services', 'personas.service_id', '=', 'services.id')
                    ->where("personas.id",$request->id)
                    ->select("personas.*","services.service_name")
                    ->get();
        return response()->json($states);
    }


    public function index(Request $request)
    {
        return view('pages.personas');
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function update(Request $request)
    {
        $id = $request->input('id');
        $updatePersona = Persona::findOrFail($id);

        $updatePersona->persona_name = $request->input('personaName');
        $updatePersona->save();

    }


    public function delete(Request $request) {

        $id = $request->input('id');
        Persona::find($id)->delete();

    }

    function insert(Request $request)
    {

        $personaName = $request->input('personaName');
        $serviceID = $request->input('serviceID');
        $persona = array('persona_name'=>$personaName, 'persona_status'=>'active', 'service_id'=>$serviceID);

        DB::table('personas')->insert($persona);


    }
}

