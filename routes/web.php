<?php



Route::get('/', 'FrontController@index');
//首頁
Route::get('/news', 'FrontController@news');//list page

Route::get('/news/{id}', 'FrontController@news_detail'); //Content Page
Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => 'home'], function () {

    Route::get('/', 'HomeController@index');
    //登入畫面的首頁
    ////////////////////////消息區/////////////////////////////
    Route::get('/news', 'NewsController@index');
    //最新消息管理

    Route::get('news/create', 'NewsController@create');
    Route::post('news/store', 'NewsController@store');
    //新增消息&儲存

    Route::get('news/edit/{id}', 'NewsController@edit');
    Route::post('news/update/{id}', 'NewsController@update');
    //修改消息&更新
    Route::post('news/delete/{id}', 'NewsController@delete');
    //刪除消息
    Route::post('ajax_delete_news_imgs', 'NewsController@ajax_delete_news_imgs');
    /////////////////////////產品區/////////////////////////////
    Route::get('/products','ProductsController@index');

    Route::get('products/create', 'ProductsController@create');
    Route::post('products/store', 'ProductsController@store');
    //新增產品&儲存

    Route::get('products/edit/{id}', 'ProductsController@edit');
    Route::post('products/update/{id}', 'ProductsController@update');
    //修改產品&更新
    Route::post('products/delete/{id}', 'ProductsController@delete');
    //刪除產品




});
