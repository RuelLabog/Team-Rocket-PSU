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
    return redirect('/login');;
});


Route::resource('/subscribers_page', 'Subscriber_AdminController');
// Route::resource('/personas_page', 'PersonaController');
Route::resource('/operators_page', 'OperatorController');
// Route::resource('/services_page', 'ServicesController');
Route::resource('/pairing_page', 'PairController');

Auth::routes();


// subscribers routes
Route::get('/subscriber', 'SubscriberController@index')->name('subscriber');
Route::get('/login/subscriber', 'Auth\LoginController@showSubscriberLoginForm');
Route::post('/login/subscriber', 'Auth\LoginController@subscriberLogin');
Route::post('/logout/subscriber', 'Auth\LoginController@logoutSubs')->name('logoutSubs');

//service routes
Route::post('/deleteService', 'ServicesController@delete')->name('deleteService');
Route::post('/editService', 'ServicesController@update')->name('editService');
Route::post('/fecthService', 'ServicesController@fetch')->name('fecthService');
Route::post('/insertService', 'ServicesController@insert')->name('insertService');
Route::get('/services', 'ServicesController@index');
Route::get('/getServices', 'ServicesController@getData');

//persona routes
Route::post('/deletePersona', 'PersonaController@delete')->name('deletePersona');
Route::post('/editPersona', 'PersonaController@update')->name('editPersona');
Route::post('/fecthPersona', 'PersonaController@fetch')->name('fecthPersona');
Route::post('/insertPersona', 'PersonaController@insert')->name('insertPersona');
Route::get('/persona', 'PersonaController@index');
Route::get('/getPersona', 'PersonaController@getData');

Route::group(['middleware' => ['admin', 'auth']], function(){
    Route::get('/home', function(){
         if(Auth::user()->user_type == "admin"){
            // Route::get('/home', 'adminHomeController@index')->name('admin.home');
            return view('pages.pair');
        }else{
           return view('pages.operatorHome');
        //    return redirect('/home');
        }
    });
});

// Blade::setContentTags('<<', '>>');
// Blade::setEscapedContentTags('<<<', '>>>');

/*

*/
