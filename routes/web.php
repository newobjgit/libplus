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
   

//Просмотр книг
Route::group(['middleware' => ['auth','permission:view-book']], function () {

    Route::get('/','MenuController@index')->name('index');
    Route::post('/','MenuController@filter')->name('path');    

    Route::resource('doc','DocController', ['only' => [
        'index', 'show']]);
    Route::post('/download','FileController@downloadFile')->name('downloadFile');
    
    //редактирование
    Route::group(['middleware' => ['permission:edit-book']] , function () {
        Route::resource('doc','DocController', ['only' => [
             'update','edit']]);
    });

    //добавление
    Route::group(['middleware' => ['permission:add-book']] , function () {
        Route::resource('doc','DocController', ['only' => [
            'store']]);
        Route::get('/create','AdminController@createDoc')->name('create');
    });

    //удаление
    Route::group(['middleware' => ['permission:delete-book']] , function () {

        Route::resource('doc','DocController', ['only' => [
            'destroy']]);
    });
});

//Админка
Route::group(['prefix'=>'admin','middleware'=>['auth', 'role:admin']] , function () {

    Route::get('/', 'AdminController@execute')->name('admin');

    Route::resource('role', 'RolesController', ['only' => [
        'edit', 'update', 'index']]);

    Route::resource('user', 'UserController', ['only' => [
        'update', 'index']]);
});


//Авторизация, регистрация и т.д
Auth::routes();

//DB::listen(function($query) {
//    dump($query->sql);
//});


