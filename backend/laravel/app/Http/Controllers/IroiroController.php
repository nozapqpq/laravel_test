<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// クエリビルダ用
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

// ORM用のデータベースormsと関連付けて作成したクラスormを使用する
use App\Models\models\orm;
// サービスコンテナ説明用の加減乗除クラス
use App\Components\Calculation;

class IroiroController extends Controller
{
    // クエリビルダとORM
    public function query_sample(){
        $sample = DB::table('sample')->get();
        return view('query_sample',['sample'=>$sample]);
    }

    public function orm_sample(){
        // 条件指定のサンプル(idが5未満のレコードを取得)
        //$sample = orm::where('id','<',5)->get();

        // 主キーidを指定するにはfind()メソッド、id = 1のレコードを取得の例
        //$sample = orm::find(1);

        // テーブルに新しいレコードを挿入するsave()メソッド
        /*
        $orm_cls = new orm();
        $orm_cls->sample1 = "abc";
        $orm_cls->sample2 = "abc1";
        $orm_cls->save();
        */
        // データ更新もsave()メソッドを使用
        /*
        $target = orm::find(10);
        $target->sample1 = "cde";
        $target->sample2 = "cde1";
        $target->save();
        */
        // レコードの削除をするdelete()メソッド
        /*
        orm::where('sample1','cde')->delete();
        */

        // firstOrCreate()メソッド
        // 送信データに該当するレコードが存在しなければレコードを1件挿入
        // これを使用するにはモデルクラスにfillableの設定が必要
        /*
        $orm_data = orm::firstOrCreate(
            ['sample1' => 'ggg'],
            ['sample2' => 'ggg1']
        );
        */

        $sample = orm::all();
        return view('query_sample',['sample'=>$sample]);
    }

    // サービスコンテナでのDIの説明用、コンストラクタインジェクション
    // di_sampleメソッドがCalculationクラスに依存しないようにしてそのクラスのメソッド(add, sub, ..)を使えるようにする
    public function __construct(Calculation $Calculation) {
        $this->Calculation = $Calculation;
    }

    public function di_sample() {
        $result = [
            'add' => $this->Calculation->add(1, 1),
            'sub' => $this->Calculation->sub(2, 1),
            'mul' => $this->Calculation->mul(3, 2),
            'div' => $this->Calculation->div(4, 2),
        ];
        return view('query_sample',['sample'=>implode($result)]);
    }
}
