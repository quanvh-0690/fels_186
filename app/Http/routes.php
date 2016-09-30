<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
});
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin', ], function (){
    Route::get('/',[
        'as' => 'admin.home',
        'uses' => 'AdminController@index',
    ]);
    Route::resource('categories', 'CategoryController');
    Route::resource('lessons', 'LessonController');
    Route::get('words/search', [
        'as' => 'admin.words.search',
        'uses' => 'WordController@search',
    ]);
    Route::resource('words.answers', 'AnswerController', [
        'except' => ['index']
    ]);
    Route::resource('words', 'WordController');
    Route::get('users/search', [
        'as' => 'admin.users.search',
        'uses' => 'UserController@search',
    ]);
    Route::resource('users', 'UserController');
});
