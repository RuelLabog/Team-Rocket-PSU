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
    return view('pages.dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/subscriber', 'SubscriberController@index')->name('subscriber');

Route::get('/login/subscriber', 'Auth\LoginController@showSubscriberLoginForm');
Route::post('/login/subscriber', 'Auth\LoginController@subscriberLogin');

// Route::get('/subscriber', function(){
//     return view('subscriber');
// });
