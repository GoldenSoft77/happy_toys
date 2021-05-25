<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'IndexController@index');
Route::get('/products','ItemController@index');
Route::get('/category/{id}','ItemController@item');
Route::get('/product/{id}','ItemController@single');
Route::get('/about','AboutController@index');
 


// Admin Routes
Route::get('/admin','AdminController@create');


// Admin Slider
Route::get('/admin/slider','SliderController@admin');
Route::get('/admin/slider/add','SliderController@create');
Route::post('/admin/slider/store','SliderController@store');
Route::get('/admin/slider/edit/{id}','SliderController@edit');
Route::post('/admin/slider/update/{id}','SliderController@update');
Route::delete('/admin/slider/delete/{id}','SliderController@destroy');

//Admin Category 
Route::get('/admin/categories','CategoryController@admin');
Route::get('/admin/category/add','CategoryController@create');
Route::post('/admin/category/store','CategoryController@store');
Route::get('/admin/category/edit/{id}','CategoryController@edit');
Route::post('/admin/category/update/{id}','CategoryController@update');
Route::delete('/admin/category/delete/{id}','CategoryController@destroy');

//Admin Item 
Route::get('/admin/items','ItemController@admin');
Route::get('/admin/item/add','ItemController@create');
Route::post('/admin/item/store','ItemController@store');
Route::get('/admin/item/edit/{id}','ItemController@edit');
Route::post('/admin/item/update/{id}','ItemController@update');
Route::delete('/admin/item/img/delete/{id}','ItemController@imagedelete');
Route::get('/admin/category/item/{id}','ItemController@show');
Route::delete('/admin/item/delete/{id}','ItemController@destroy');

// Admin About us
Route::get('/admin/about','AboutController@show');
Route::post('/admin/about/update','AboutController@update');

Auth::routes();

