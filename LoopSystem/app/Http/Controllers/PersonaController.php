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
        return Persona::all();
        return Service::all();
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
        $persona = array('persona_name'=>$personaName, 'persona_status'=>'active', 'service_id'=>'1');

        DB::table('personas')->insert($persona);


    }
}

