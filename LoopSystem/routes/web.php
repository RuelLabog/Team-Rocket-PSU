<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/index', function () {
//     return view('pages.index');
// });
// Route::get('/zzz', function () {
//     return view('pages.home');
// });
Route::get('/index', function () {
    return view('pages.index');
});
Route::get('/zzz', function () {
    return view('pages.home');
});
Route::get('/xxx', function () {
    return view('pages.subscribers');
});

Route::resource('/subscribers_page', 'Subscriber_AdminController');
Route::resource('/personas_page', 'PersonaController');
Route::resource('/operators_page', 'OperatorController');
Route::resource('/services_page', 'ServicesController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/subscriber', 'SubscriberController@index')->name('subscriber');
    // Route::get('/adminhome', 'adminHomeController@index')->name('admin.home')->middleware('admin');


Route::get('/login/subscriber', 'Auth\LoginController@showSubscriberLoginForm');
Route::post('/login/subscriber', 'Auth\LoginController@subscriberLogin');

Route::group(['middleware' => ['admin', 'auth']], function(){
    // Route::get('/home', 'adminHomeController@index')->name('admin.home');
    Route::get('/home', function(){
        if(Auth::user()->user_type == "admin"){
            // Route::get('/home', 'adminHomeController@index')->name('admin.home');
            return view('pages.admin');
        }else{
            return view('pages.home');
        //    return redirect('/home');
        }
    });
});

