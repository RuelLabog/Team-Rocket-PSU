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


// Route::get('/subscriber', function(){
//     return view('subscriber');
// });

/*
finished multi auth guards login
created admin middleware to redirect the user(operator) and admin in different page after login
discussed the system's process flow (w/ the team)


*/
