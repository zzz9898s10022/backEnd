<?php

Auth::routes();

Route::get('/', 'FrontController@index');
//首頁
Route::get('/news', 'FrontController@news');

Route::group(['middleware' => ['auth'],'prefix' => 'home'],function(){

    Route::get('/', 'HomeController@index');

    Route::get('/news', 'NewsController@index');

    //最新消息管理
    Route::get('news/create','NewsController@create');
    Route::post('news/store','NewsController@store');

    Route::get('news/edit/{id}', 'NewsController@edit');
    Route::post('news/update/{id}', 'NewsController@update');
    
    Route::post('news/delete','NewsController@delete');

});

