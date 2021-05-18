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
// cssファイルはpublic内のstyle.scssに記入

// トップ画面
Route::get('/', 'App\Http\Controllers\CookController@welcomeview')->name('welcome');
// レシピ登録画面
Route::get('/cookregister', 'App\Http\Controllers\CookController@registerview')->name('cookregister');
Route::post('/cookregister', 'App\Http\Controllers\CookController@register')->name('cookpost');
// レシピの詳細ページ
Route::get('/cookdetail', 'App\Http\Controllers\CookController@detailview')->name('cookdetail');
