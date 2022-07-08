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
Route::get('greeting', function() {
    return 'Hello World';
});
Route::get('netkeiba','App\Http\Controllers\ScrapingController@netkeiba');
Route::get('google_search','App\Http\Controllers\ScrapingController@google_search');
Route::post('kaisai', 'App\Http\Controllers\KaisaiImportController@index');
Route::get('home', 'App\Http\Controllers\HomeController@index');

Route::get('page_abstruct', 'App\Http\Controllers\PageAbstructController@index');
Route::get('page_routing', 'App\Http\Controllers\PageAbstructController@routing');
Route::get('page_request', 'App\Http\Controllers\PageAbstructController@request');
Route::post('request_post', 'App\Http\Controllers\RequestSampleController@request_post');
Route::get('page_query_builder', 'App\Http\Controllers\PageAbstructController@query_builder');
Route::post('query_sample', 'App\Http\Controllers\IroiroController@query_sample');
Route::get('page_orm', 'App\Http\Controllers\PageAbstructController@orm');
Route::post('orm_sample', 'App\Http\Controllers\IroiroController@orm_sample');
Route::get('page_di', 'App\Http\Controllers\PageAbstructController@di');
Route::post('di_sample', 'App\Http\Controllers\IroiroController@di_sample');
Route::get('page_cert', 'App\Http\Controllers\PageAbstructController@cert');
Route::get('page_test', 'App\Http\Controllers\PageAbstructController@test');
Route::get('page_artisan', 'App\Http\Controllers\PageAbstructController@artisan');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/*
 * ***パッケージ、composer関連の情報***
 * 最初に下記をcomposerに取り込む必要がある。取り込むとcomposer.lockが更新される
 * composer require rap2hpoutre/fast-excel
 * composer require weidner/goutte：古めのlaravelしか使えなさそう
 * composer require fabpot/goutte
 * 
 * composerのリセットはcomposer install
 * インストールされているパッケージの確認はcomposer show -i
 * 
 * キャッシュのクリア
 * php artisan config:clear
 * 
 * データベースはこう
 * まず.envのDB_HOST,ユーザ名パスワードなど設定(このファイルの更新はgitにコミットしない)
 * 次にmysqlにデータベースを作る
 * php artisan make:migration create_hoge_table
 * データベースのマイグレーションの実行(未処理のものすべてを実行)
 * php artisan migrate

 * できたら次はControllerの作成
 * php artisan make:controller HOGEController
 * 
 * viewについて
 * Laravelでビューを新規作成するとき注意するべきポイントは
 *
 * 1. ビューを新規作成するコマンドは無い
 * 2. ビューの格納場所はresources\views配下に格納する
 * 3. 拡張子は【.blade.php】とする
 */
