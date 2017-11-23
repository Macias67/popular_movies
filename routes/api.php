<?php

use Illuminate\Http\Request;
use App\Movies;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//se definen las rutas de la api para los metodos a utilizar
Route::get('favoritas','FavoritasController@index');
Route::post('favoritas','FavoritasController@store');
Route::delete('favoritas/{id}','FavoritasController@delete');