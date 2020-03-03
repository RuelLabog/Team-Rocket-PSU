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
    return redirect('/login');
});

// Route::get('/login', function () {
//     return view('auth/login');
// });

Auth::routes();

//dashboard route

// Route::group(['middleware'=>'auth'], function(){


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@totalItems')->name('totalItems');
Route::get('/sidebar', 'tryController@image');

//items routes
Route::resource('/items', 'ItemsController');
Route::resource('/items_page', 'ItemsController');
Route::post('/increaseItem', 'ItemsController@increaseQuantity')->name('itemIncrease');
Route::post('/editItem', 'ItemsController@update')->name('itemEdit');
Route::post('/reduceItem', 'ItemsController@updateQuantity')->name('itemReduce');
// Route::post('/editCat', 'CategoriesController@update')->name('catEdit');
// Route::get('/items', 'ItemsController@getData');
Route::post('/softdelitem', 'ItemsController@delete')->name('itemSoftDelete');
Route::post('/getItem', 'ItemsController@edit')->name('itemGetDataToEdit');
Route::post('/addItem','ItemsController@insert')->name('itemAdd');
//Route::post('/items','ItemsController@insert')->name('itemInsert');
Route::post('items/insert', 'Items@insert')->name('items.insert');
Route::post('/items','ItemsController@insert');


//categoies routes
Route::resource('/categories', 'CategoriesController');
Route::resource('/categories_page', 'CategoriesController');
Route::post('/softDelCat', 'CategoriesController@delete')->name('catSoftDelete');
Route::post('/editCat', 'CategoriesController@update')->name('catEdit');
Route::post('/categories','CategoriesController@insert');
Route::post('/categories','CategoriesController@insert')->name('categoryInsert');
Route::post('/restoreCat', 'CategoriesController@restore')->name('categoryRestore');
Route::post('/forceDelCat', 'CategoriesController@forceDelete')->name('categoryForceDel');
//users routes
<<<<<<< HEAD
Route::resource('/users_page', 'UsersController')->middleware('superAdmin');
=======
// Route::get('/users', 'UsersController@getData');
Route::resource('/users_page', 'UsersController');
Route::post('/editUser', 'UsersController@update');
Route::post('/addUser', 'UsersController@insert')->name('addUser');
>>>>>>> eea553088b9d7bb791224fedd5020b0c8237ab10
Route::post('/softDelUser', 'UsersController@destroy')->name('userSoftDelete');
Route::post('/editUser', 'UsersController@update')->name('userUpdate');
Route::post('/addUser', 'UsersController@insert')->name('userAdd');

//profile routes
Route::resource('/profile_page', 'ProfileController');
Route::get('/profile', 'ProfileController@getData');

//receipt routes
Route::resource('/receipt', 'ReceiptController');
Route::resource('/receipts_page', 'ReceiptController');
Route::post('/softDelRec', 'ReceiptController@delete')->name('recSoftDelete');
Route::post('/editRec', 'ReceiptController@update')->name('recEdit');
Route::post('/receipt','ReceiptController@insert')->name('receiptInsert');
Route::post('/restoreRec', 'ReceiptController@restore')->name('receiptRestore');
Route::post('/forceDelRec', 'ReceiptController@forceDelete')->name('receiptForceDel');

// });


