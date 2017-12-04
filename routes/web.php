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
    return view('welcome');
});

//view items
Route::get('All-Items','ItemController@index');

Route::get('Update','ItemController@get_update_view');


//view users
Route::get('All-Users','Authcontroller@index');

Route::delete('Delete-Users/{id}','Authcontroller@Delete_User');
Route::delete('Delete-item/{id}','ItemController@Delete_Item');

Route::put('update-item/{id}','ItemController@Update_Item');



