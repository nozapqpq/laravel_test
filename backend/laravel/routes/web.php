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
Route::get('netkeiba','App\Http\Controllers\ScrapingController@netkeiba');
Route::get('google_search','App\Http\Controllers\ScrapingController@google_search');

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
 */
