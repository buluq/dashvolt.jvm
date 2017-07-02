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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/product', 'HomeController@product')->name('product');
Route::get('/catalogue', 'HomeController@catalogue')->name('catalogue');
Route::get('/journal/catalogue', 'HomeController@journalCatalogue')->name('catalogue_journal');
Route::post('/journal/catalogue', 'HomeController@catalogueUpdate');

Route::resource('website', 'WebsiteController');
Route::resource('product', 'ProductController');

Route::get('/import/product', 'ProductController@importForm');
Route::post('/import/product', 'ProductController@import');
Route::post('/export/{type}', 'ProductController@export');
