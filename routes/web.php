<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function(){
    return view('home.blade.php');
});

Route::get('/register','AuthController@regist')->name('regist');
Route::post('/register','AuthController@create')->name('auth.regist');

Route::get('/login', 'AuthController@index')->name('login')->middleware('guest');
Route::post('/login', 'AuthController@login')->name('auth.login');
