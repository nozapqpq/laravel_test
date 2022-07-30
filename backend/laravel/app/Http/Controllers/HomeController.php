<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home');
    }
    public function auto_buy() {
        return view('auto_buy');
    }

    // テスト用のサンプルメソッド
    // 電話番号をxxx-xxx-xxxxの形で返す
    public function get_phone_number(string $s1, string $s2, string $s3) {
        return $s1."-".$s2."-".$s3;
    }
    // 電話番号を繋げる記号が誤っているバージョン
    public function get_phone_number_fail(string $s1, string $s2, string $s3) {
        return $s1.$s2."+".$s3;
    }
}
