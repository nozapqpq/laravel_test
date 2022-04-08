<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;

class KaisaiImportService {

    public function kaisaiImport(Request $request){
        // 用途 : 対netkeibaアドレス取得用のデータベースへの入力
        $uploaded_file = $request->file('csvdata'); 
        $orgName = date('YmdHis') ."_".$request->file('csvdata')->getClientOriginalName();
        $spath = storage_path('app/');
        $path = $spath.$request->file('csvdata')->storeAs('',$orgName); 

        // CSVファイルを読み込む
        $result = (new FastExcel)->configureCsv(',','"','Shift-JIS',false)->importSheets($path);
        // DB登録処理
        DB::table('kaisai')->truncate();
        foreach ($result as $row) {
            foreach($row as $item) {
                $ymd_array = $this->get_date_array($item["日付"]);
                $kaisai_array = $this->get_kaisai_array($item["開催"]);
                $race_id = sprintf("%04d%02d%02d%02d",
                    $ymd_array["year"],
                    $this->get_place_number($kaisai_array["place"]),
                    $kaisai_array["kaisai_times"],
                    $kaisai_array["kaisai_days"]);
                $param = [
                    'year' => $ymd_array["year"],
                    'month' => $ymd_array["month"],
                    'day' => $ymd_array["day"],
                    "kaisai_times" => $kaisai_array["kaisai_times"],
                    "place" => '"'.$kaisai_array["place"].'"',
                    "kaisai_days" => $kaisai_array["kaisai_days"],
                    "race_id" => $race_id,
                ];
                DB::table('kaisai')->insert($param);
            }
        }


    }

    // 入力 : YYMMDDの形式の文字列
    // 出力 : 年、月、日のarray
    private function get_date_array(string $raw_date){
        $y = intval(substr($raw_date,0,2));
        if ($y < 40) {
            $y += 2000;
        } else {
            $y += 1900;
        }
        $m = intval(substr($raw_date,2,2));
        $d = intval(substr($raw_date,4));
        return ["year"=>$y, "month"=>$m, "day"=>$d];
    }

    // 入力 : 開催、場所、日目が"1中8"の形式
    // 出力 : 開催、場所、日目のarray
    private function get_kaisai_array(string $raw_kaisai){
        $times = intval(substr($raw_kaisai,0,1));
        $place = $this->convert_raw_place(substr($raw_kaisai,1,3));
        $days = intval(substr($raw_kaisai,4),16);

        return ["kaisai_times"=>$times, "place"=>$place, "kaisai_days"=>$days];
    }

    // 入力 : 場所を表す１文字
    // 出力 : 場所
    private function convert_raw_place(string $place_word){
        switch($place_word){
            case "札":
                return "札幌";
            case "函":
                return "函館";
            case "福":
                return "福島";
            case "新":
                return "新潟";
            case "東":
                return "東京";
            case "中":
                return "中山";
            case "名":
                return "中京";
            case "京":
                return "京都";
            case "阪":
                return "阪神";
            case "小":
                return "小倉";
        }
    }

    // 入力 : 場所
    // 出力 : netkeiba.comで対応する番号
    private function get_place_number(string $place){
        switch($place){
            case "札幌":
                return 1;
            case "函館":
                return 2;
            case "福島":
                return 3;
            case "新潟":
                return 4;
            case "東京":
                return 5;
            case "中山":
                return 6;
            case "中京":
                return 7;
            case "京都":
                return 8;
            case "阪神":
                return 9;
            case "小倉":
                return 10;
        }
    }
}