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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('/', 'HomeController@profile')->name('profile');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('user', 'UserController');
Route::resource('catalogue', 'CatalogueController');
Route::resource('product', 'ProductController');
Route::resource('stats', 'StatController');
Route::resource('website', 'WebsiteController');

Route::get('/import/product', 'ProductController@importForm')->name('import_product');
Route::post('/import/product', 'ProductController@import');
Route::post('/export/{type}', 'ProductController@export');
