<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\item;
use App\category;
use Illuminate\Support\Facades\Redirect;
use DB;
date_default_timezone_set('Asia/Manila');

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

    function totalItems(){
        $items['items'] = DB::table('items')->get()
                        ->where('deleted_at', '=', null)->count();

        $categories['categories'] = DB::table('categories')->get()
                        ->where('deleted_at', '=', null)->count();
        $users['users'] = DB::table('users')->get()
                        ->where('deleted_at', '=', null)->count();
        $receipts['receipts'] = DB::table('receipts')->get()
                        ->where('deleted_at', '=', null)->count();
        $departments = array(
            'Admin and Finance Department',
            'Human Resources and Development',
            'Information Technology & Development',
            'Messaging Support Team',
            'Sales and Marketing',
            'Production Recruitment Department'
        );


            $datas = array();
            for ($i=0; $i < count($departments) ; $i++) {
                //$transactions['transactions'] = DB::table('transactions')->get()
                        //->where('department', '=', $departments)->count();
                array_push($datas, DB::table('transactions')->get()
                        ->where('department', '=', $departments[$i])->sum('quantity'));
            }




        if(count($items) > 0){
            return view('pages.dashboard',  ['items' => $items, 'categories' => $categories, 'users' => $users, 'receipts' => $receipts, 'datas' => $datas]);
        }
        else{
            return view('pages.dashboard');
        }
    }




}
