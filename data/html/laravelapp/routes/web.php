<?php

use Illuminate\Support\Facades\Route;

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

Route::get('hello/{msg?}', 'HelloController@index');
// Route::get('hello', function() {
//     return view('hello.index');
// });
Route::post('hello', 'HelloController@post');

Route::get('hello/other', 'HelloController@other');

Route::get('single-hello', 'HelloSingleActionController');

Route::get('RRV/{id?}', 'RequestResponseViewController@index');