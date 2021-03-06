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
Route::post('/', 'App\Http\Controllers\CookController@cooksearch')->name('ichicooksearch');
// レシピ登録画面
Route::get('/cookregister', 'App\Http\Controllers\CookController@registerview')->name('cookregister');
Route::post('/cookregister', 'App\Http\Controllers\CookController@register')->name('cookpost');
// csvによる一括登録処理
Route::get('/cookregiter/csv', function () { return view('cook.csv'); })->name('showCsvFrom');
Route::post('/cookregister/csv', 'App\Http\Controllers\CookController@registerByCsv')->name('registerByCsv');
Route::get('/cookregister/csv/download', 'App\Http\Controllers\CookController@downloadCsv')->name('downloadCsv');
// レシピ更新画面
Route::get('/cookupdate', 'App\Http\Controllers\CookController@showcookupdate')->name('showcookupdate');
Route::post('/cookupdate', 'App\Http\Controllers\CookController@updaterecipe')->name('updaterecipe');
// レシピの詳細ページ
Route::get('/cookdetail', 'App\Http\Controllers\CookController@detailview')->name('cookdetail');
// 検索結果のページ
Route::get('/cooksearch', 'App\Http\Controllers\CookController@cooksearch')->name('cooksearch');
// ログインのページ
Route::get('/login', 'App\Http\Controllers\CookController@showcooklogin')->name('showcooklogin');
Route::post('/login', 'App\Http\Controllers\CookController@cooklogin')->name('cooklogin');





