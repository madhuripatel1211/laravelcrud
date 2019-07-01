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

Route::get('/', 'CategoryListController@index');

Route::get('/productlist/{id}', 'CategoryListController@productlist');

Route::resource('category','CategoryController')->middleware('auth');
Route::post('/category/edit/{id}','CategoryController@update');
Route::post('/category/update/{id}', 'CategoryController@update')->middleware('auth');
Route::post('/category/destroy/{id}', 'CategoryController@destroy')->middleware('auth');

Route::resource('product','ProductController')->middleware('auth');
Route::post('/product/edit/{id}','ProductController@update');
Route::post('/product/update/{id}', 'ProductController@update')->middleware('auth');
Route::post('/product/destroy/{id}', 'ProductController@destroy')->middleware('auth');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
