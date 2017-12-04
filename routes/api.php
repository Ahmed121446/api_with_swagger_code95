<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//view items
Route::get('All-Items','ItemController@index');
//view users
Route::get('All-Users','Authcontroller@index');

Route::get('Update','ItemController@get_update_view');



Route::delete('Delete-Users/{id}','Authcontroller@Delete_User');

Route::delete('Delete-item/{id}','ItemController@Delete_Item');

Route::put('update-item/{id}','ItemController@Update_Item');



Route::post('auth/register', 'Authcontroller@register');
Route::get('auth/register', 'Authcontroller@Get_register_View');

Route::post('auth/login', 'Authcontroller@login');
Route::get('auth/login', 'Authcontroller@Get_Login_View');


Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('AuthUser-Info', 'Authcontroller@Get_Auth_User_Information');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
