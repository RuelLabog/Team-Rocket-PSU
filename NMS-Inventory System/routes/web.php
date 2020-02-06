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

// Route::get('/login', function () {
//     return view('auth/login');
// });

Route::get('/items', function () {
    return view('pages/items_page');
});

Route::get('/categories', function () {
    return view('pages/categories_page');
});

Route::get('/users', function () {
    return view('pages/users_page');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('items_page', 'ItemsController');


Route::get('/items', 'ItemsController@getData');

Route::get('/categories', 'CategoriesController@getData');
Route::get('/users', 'UsersController@getData');

Route::post('/items','ItemsController@insert');
Route::post('/categories','CategoriesController@insert');
