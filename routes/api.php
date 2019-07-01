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
//     Route::resource('product', 'API\ProductController');
// });

 Route::post('login', 'Api\AuthController@login');
 Route::post('register', 'Api\AuthController@register');
 Route::resource('product', 'API\ProductController');
 Route::resource('category', 'API\CategoryController');

  
