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

Route::get('/', 'HomeController@index');
Route::get('/login', 'HomeController@index');
Route::get('/signin', 'HomeController@index');
Route::get('/profile', 'HomeController@index');
Route::get('/nextSunday', 'HomeController@index');
Route::get('/songs', 'HomeController@index');
Route::get('/plans', 'HomeController@index');

Auth::routes();