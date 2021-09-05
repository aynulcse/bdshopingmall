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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/','Frontend\PagesController@indexsliderapi');
Route::get('/category','Frontend\PagesController@indexcategoryapi');
Route::get('/product','Frontend\PagesController@indexproductapi');
Route::get('/details/{id}','Frontend\PagesController@product_showapi');
Route::post('/loginuser','Auth\LoginController@loginuser');
Route::post('/register','Auth\RegisterController@registeruser');