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

Route::get('/', function () {
    return view('welcome');
});

Route::any('/score', ['uses' => 'ScoreController@Score', 'as' => 'score']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'contact'], function () {
    Route::get('/', ['uses' => 'ContactController@index', 'as' => 'contact.index']);
    Route::post('/store', ['uses' => 'ContactController@store', 'as' => 'contact.store']);
    Route::get('/delete/{id?}', ['uses' => 'ContactController@destroy', 'as' => 'contact.delete']);
    Route::get('/edit/{id?}', ['uses' => 'ContactController@edit', 'as' => 'contact.edit']);
    Route::patch('/update', ['uses' => 'ContactController@update', 'as' => 'contact.update']);
});
