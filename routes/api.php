<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('external-books/{name?}', 'demoTestController@searchBookWithParam');
Route::get('books', 'demoTestController@getBook');
Route::get('books/{id}', 'demoTestController@showBook');
Route::post('books', 'demoTestController@createBook');
Route::put('books/{id}', 'demoTestController@updateBook');
Route::delete('books/{id}', 'demoTestController@deleteBook');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
