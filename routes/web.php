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


Route::resource('api/articles','ApiController');

Route::post('user-articles/{id}','ApiController@showArticlesByUser');


Route::get('articles','PagesController@allArticles');

Route::get('profile','PagesController@profile')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
