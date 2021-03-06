<?php

use App\Http\Controllers\NamesController;
use Illuminate\Support\Facades\Auth;
use App\HTTP\Middleware\RemoveToken;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('names/update', 'NamesController@updateName')->middleware(['auth','removetoken']);

Route::resource('names', "NamesController")->middleware(['auth','removetoken']);