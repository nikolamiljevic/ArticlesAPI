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

//rute za api kontroler
Route::resource('api/articles','ApiController');

//prikaz clanaka po korisniku na profilnoj stranici i filter na stranici sa svim artiklima
Route::get('user-articles/{id}','ApiController@showArticlesByUser');


//stranica sa svim artiklima
Route::get('articles','PagesController@allArticles');


//profilna stranica sa artiklima odredjenog korisnika
Route::get('profile','PagesController@profile')->middleware('auth');

//edit stranica
Route::get('edit/{id}','PagesController@edit')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
