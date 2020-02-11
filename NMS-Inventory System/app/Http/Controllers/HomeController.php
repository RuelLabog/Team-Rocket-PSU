<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\item;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function getData(){
        $data['data'] = DB::table('users')->get()
                        ->where('id', '=', auth()->user()->id);

        if(count($data) > 0){
            return view('pages/profile_page', $data);
        }
        else{
            return view('pages/profile_page');
        }
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.dashboard');
    }

        public function user_status()
    {
        $user = auth()->user();
        return view('includes.admin_template', compact("user"));
    }

}
