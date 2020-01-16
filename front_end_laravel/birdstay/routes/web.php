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

Route::get('/contact', 'PageController@contact')->name('contact');
Route::get('/', 'BirdController@index')->name('homepage');
Route::resource('/birds', 'BirdController');
Route::resource('/locations', 'LocationController');
Route::patch('/birds/found/{bird}','BirdController@found')->name('birds.found');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
