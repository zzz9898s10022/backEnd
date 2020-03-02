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

// Route::get('/', function () {
//     return view('front/index');
// });

// Route::get('/news', function () {
//     return view('front/news');
// });


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'FrontController@index');
Route::get('/news', 'FrontController@news');


Route::get('/home/news', 'NewsController@index');
Route::post('/home/news/store','NewsController@store');

