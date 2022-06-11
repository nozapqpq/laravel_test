<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orm extends Model
{
    use HasFactory;
    // デフォルトと異なる設定をしたい場合はここに書く
    // テーブルの指定
    // protected $table = 'other_tables';
    // 主キーの指定
    // protected $primaryKey = 'other_id';
    // タイムスタンプの指定
    // public $timestamps = false // create_atとupdated_atの自動更新をOFFにする
    // protected $dateFromat = 'U'; // 日付カラムのフォーマットを指定
    // const CREATED_AT = 'create_dt'; // 作成日時カラムの指定
    // データベースの指定
    // protected $connection = 'other_db';

    // [躓きポイント]firstOrCreate等使用したい場合はMass Assignmentの対策が必要
    // Web上から入力されてきた値を制限することで不正なパラメータを防ぐ仕組み
    protected $fillable = ['sample1', 'sample2'];
}
