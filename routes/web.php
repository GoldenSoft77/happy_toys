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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
});


// Categories 
Route::get('/admin/categories', 'CategoryController@index');
Route::get('/admin/categories/add', 'CategoryController@create');
Route::get('/admin/categories/edit/{id}', 'CategoryController@edit');
Route::post('/admin/categories/store', 'CategoryController@store');
Route::post('/admin/categories/update/{id}', 'CategoryController@update');
Route::delete('/admin/categories/delete/{id}', 'CategoryController@destroy');

// Sliders
Route::get('/admin/sliders', 'SliderController@index');
Route::get('/admin/sliders/add', 'SliderController@create');
Route::get('/admin/sliders/edit/{id}', 'SliderController@edit');
Route::post('/admin/sliders/store', 'SliderController@store');
Route::post('/admin/sliders/update/{id}', 'SliderController@update');
Route::delete('/admin/sliders/delete/{id}', 'SliderController@destroy');

// Products
Route::get('/admin/products', 'ProductController@index');
Route::get('/admin/products/add', 'ProductController@create');
Route::get('/admin/products/edit/{id}', 'ProductController@edit');
Route::post('/admin/products/store', 'ProductController@store');
Route::post('/admin/products/update/{id}', 'ProductController@update');
Route::delete('/admin/products/delete/{id}', 'ProductController@destroy');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
