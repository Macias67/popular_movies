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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//se define la ruta al login
Route::get('/',function(){
    return view('auth/login');
});
//se define la ruta al controlador ControllerMovies y a la funcion getPopular
Route::get('popular_movies','ControllerMovies@getPopular');
//se define la ruta para peliculas favoritas
Route::get('myfavorites','FavoritasController@index');