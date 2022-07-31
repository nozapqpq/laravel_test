<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class YumaAnalysisController extends Controller
{
    // 期待値1の配当を何円とするか
    const DIVIDEND_CRITERIA = 40000;
    const DOWNLOAD_PATH = '/var/www/laravel/download/';
    public function index() {
        return view('home');
    }
    // onloadを利用してボタンを押さずに自動的に購入する
    // dateで指定した日付にかかわらず当日の、指定したレースの馬番を買ってしまうため正しく日付を指定したか確認すること
    public function time_trigger(Request $request) {
        $time_trigger_json = file_get_contents(self::DOWNLOAD_PATH."time_trigger.json");
        $time_trigger_obj = json_decode($time_trigger_json,true);
        $flg = false;
        for ($i=0; $i<count($time_trigger_obj["hm"]); $i++) {
            if (strtotime('+9 hour', strtotime(date('G:i:00'))) == strtotime(date($time_trigger_obj["hm"][$i]))){
                $year = $time_trigger_obj["year"];
                $month = $time_trigger_obj["month"];
                $date = $time_trigger_obj["date"];
                $odds_damping_ratio = $time_trigger_obj["odds_damping_ratio"];
                $race = $time_trigger_obj["race"][$i];
                $place = $time_trigger_obj["place"][$i];
                $time = $time_trigger_obj["time"][$i];
                $flg = true;
                echo $year.$month.$date.$odds_damping_ratio."<br>";
                break;
            }
        }
        if ($flg == true) {
            if ($time % 100 <= 5) {
                $time -= 46; // 1000の6分前は994でなく954
            } else {
                $time -= 6;
            }
            // 前回のデータが残ったまま新しいデータができないと結果がおかしくなることがあるので一応諸々削除
            if (file_exists(self::DOWNLOAD_PATH."auto_buy.json")){
                unlink(self::DOWNLOAD_PATH."auto_buy.json");
                unlink(self::DOWNLOAD_PATH."scrape_output.json");
                unlink(self::DOWNLOAD_PATH."yuma_temp.jpg");
                unlink(self::DOWNLOAD_PATH."yuma_temp_shironuri.png");
            }

            echo $year."/".$month."/".$date."(".$race."R)".$place.$time."<br>";
            
            $scrape_input = array('place'=>$place,'year'=>$year,'month'=>$month,'date'=>$date,'race'=>$race);

            // データ処理本体
            // ゆまちゃん画像取得、白塗り
            $this->exec_yuma_shironuri($year, $month, $date, $time,'yuma_temp.jpg');
            // 画像解析
            $image_analysed = $this->analyse_yuma_image('yuma_temp_shironuri.png');
            // オッズ取得
            $scrape_obj = $this->exec_odds_scraper($scrape_input);
    
            // 出力、データ解析
            $umabans = $image_analysed[1];
            $win_rates = $image_analysed[2];
    
            $this->print_yuma_odds($scrape_obj["odds_info"], $umabans, $win_rates, $odds_damping_ratio);
            sleep(6);
        }
        echo "redirect<br>";
        sleep(4);
        return redirect('auto_buy');
    }
    public function extract(Request $request) {
        $attributes = $request->only(['place','race','date','hour','minute','odds_damping_ratio']);
        preg_match_all('/(\d+)-(\d+)-(\d+)/',$attributes["date"],$ymd);

        $year = intval($ymd[1][0]);
        $month = intval($ymd[2][0]);
        $date = intval($ymd[3][0]);
        $race = intval($attributes["race"]);
        $place = $attributes["place"];
        $time = intval($attributes["hour"])*100+intval($attributes["minute"]);
        $odds_damping_ratio = floatval($attributes["odds_damping_ratio"]);
        // 発走6分前ごろから情報が出る
        if ($time % 100 <= 5) {
            $time -= 46; // 1000の6分前は994でなく954
        } else {
            $time -= 6;
        }
        echo $year."/".$month."/".$date."(".$race."R)".$place.$time."<br>";
        
        $scrape_input = array('place'=>$place,'year'=>$year,'month'=>$month,'date'=>$date,'race'=>$race);

        // データ処理本体
        // ゆまちゃん画像取得、白塗り
        $this->exec_yuma_shironuri($year, $month, $date, $time,'yuma_temp.jpg');
        // 画像解析
        $image_analysed = $this->analyse_yuma_image('yuma_temp_shironuri.png');
        // オッズ取得
        $scrape_obj = $this->exec_odds_scraper($scrape_input);

        // 出力、データ解析
        $umabans = $image_analysed[1];
        $win_rates = $image_analysed[2];

        $this->print_yuma_odds($scrape_obj["odds_info"], $umabans, $win_rates, $odds_damping_ratio);

        echo "<br><br>";
        print_r($umabans);
        echo "<br>";
        print_r($win_rates);
        echo "<br>";
        print_r($scrape_obj["odds_info"]);     
    }
    public function extract_local(Request $request) {
        $attributes = $request->only(['place','race','date','hour','minute','odds_damping_ratio']);
        preg_match_all('/(\d+)-(\d+)-(\d+)/',$attributes["date"],$ymd);

        $year = intval($ymd[1][0]);
        $month = intval($ymd[2][0]);
        $date = intval($ymd[3][0]);
        $race = intval($attributes["race"]);
        $place = $attributes["place"];
        $time = intval($attributes["hour"])*100+intval($attributes["minute"]);
        $odds_damping_ratio = floatval($attributes["odds_damping_ratio"]);
        // 発走6分前ごろから情報が出る
        if ($time % 100 <= 5) {
            $time -= 47;
        } else {
            $time -= 7;
        }
        echo $year."/".$month."/".$date."(".$race."R)".$place.$time."<br>";
        
        $scrape_input = array('place'=>$place,'year'=>$year,'month'=>$month,'date'=>$date,'race'=>$race);

        // データ処理本体
        // ゆまちゃん画像取得、白塗り
        $this->exec_yuma_shironuri($year, $month, $date, $time,'yuma_temp.jpg');
        // 画像解析
        $image_analysed = $this->analyse_yuma_image('yuma_temp_shironuri.png');
        // オッズ取得
        $scrape_obj = $this->exec_odds_scraper_local($scrape_input);

        // 出力、データ解析
        $umabans = $image_analysed[1];
        $win_rates = $image_analysed[2];

        $this->print_yuma_odds($scrape_obj["odds_info"], $umabans, $win_rates, $odds_damping_ratio);

        echo "<br><br>";
        print_r($umabans);
        echo "<br>";
        print_r($win_rates);
        echo "<br>";
        print_r($scrape_obj["odds_info"]);

    }
    // ゆまちゃん競馬から画像を取り込む(python実行)
    private function exec_yuma_shironuri($year, $month, $date, $time, $filename) {
        for ($i=0;$i<400;$i++) { // 3分間で画像が出力されている前提
            if ($i % 100 >= 60) {
                continue;
            }
            $time_sec = $time*100+$i;
            if (intval($time_sec/100) % 100 >= 60) {
                $time_sec = $time*100+$i+4000;
            }
            $image_path = sprintf("https://cdn-ak.f.st-hatena.com/images/fotolife/a/ai_yuma/%04d%02d%02d/%04d%02d%02d%06d.png",$year,$month,$date,$year,$month,$date,$time_sec);
            $response = @file_get_contents($image_path);
            if ($response !== false) {
                echo $image_path."<br>";
                break;
            }
        }
        $image = file_get_contents($image_path);
        $save_path = self::DOWNLOAD_PATH.$filename;
        file_put_contents($save_path, $image);

        // いらない部分を白塗りする
        $command1="python3 ".self::DOWNLOAD_PATH."yuma_image_shironuri.py ";
        exec($command1,$output1);
    }
    // 不要部分が白塗りされたゆまちゃん画像の文字列化(google vision使用)
    private function analyse_yuma_image($filename) {
        $yuma_img = self::DOWNLOAD_PATH.$filename;
        $client = new ImageAnnotatorClient();
        $image = $client->createImageObject(file_get_contents($yuma_img));
        $response = $client->textDetection($image);
        if(!is_null($response->getError())) {
            return ['result' => false];
        }
        $annotations = $response->getTextAnnotations();
        $description = str_replace('"""', '', $annotations[0]->getDescription());

        // 解析した画像から馬番、勝率を取り出す
        preg_match_all('/(\d+)\s*[\[\(【]\s*(\d+(?:\.\d+)?)\%\s*[\]\)】]/u', $description, $numbers);

        return $numbers;
    }
    // netkeibaからのオッズ取得(python実行)
    private function exec_odds_scraper($scrape_input){
        $json = json_encode($scrape_input);
        file_put_contents(self::DOWNLOAD_PATH."scrape_input.json", $json);
        $command2="python3 ".self::DOWNLOAD_PATH."odds_scraper.py ";
        
        exec($command2,$output2);

        sleep(5);
        $scrape_output = file_get_contents(self::DOWNLOAD_PATH."scrape_output.json");
        $scrape_obj = json_decode($scrape_output,true);

        return $scrape_obj;
    }
    private function exec_odds_scraper_local($scrape_input){
        $json = json_encode($scrape_input);
        file_put_contents(self::DOWNLOAD_PATH."scrape_input.json", $json);
        $command2="python3 ".self::DOWNLOAD_PATH."odds_scraper_local.py ";
        
        exec($command2,$output2);

        sleep(1);
        $scrape_output = file_get_contents(self::DOWNLOAD_PATH."scrape_output.json");
        $scrape_obj = json_decode($scrape_output,true);

        return $scrape_obj;
    }
    private function print_yuma_odds($odds_info, $umabans, $win_rates, $odds_damping_ratio){
        $max_i = count($odds_info);
        $max_j = count($umabans);
        $win_criteria = 0;
        $cost = 0;
        $total_cost = 0;
        $exp_dividend = 0;
        $bad_exp_count = 0; // オッズ10倍以内で期待値が0.55～0.9未満の馬が3頭いる場合は惜しいところで悲惨になりそうなので買わない
        $auto_buy_array = [
            'umaban'=>[],
            'buy'=>[]
        ];

        echo "<table border=1>";
        echo "<tr>";
        echo "<td>馬番</td><td>馬名</td><td>オッズ</td><td>ゆま</td><td>期待値</td>";
        echo "</tr>";
        // odds_infoは$i, win_rates,umabansは$j
        for ($i=0;$i<$max_i;$i++) {
            echo "<tr>";
            if (count($odds_info) > $i) {
                // オッズは最後の5分でガクッと下がるので低めに見積もる
                $actual_odds = round(floatval($odds_info[$i]["odds"])*$odds_damping_ratio, 1);
                echo "<td align=right>".$odds_info[$i]["umaban"]."</td>";
                echo "<td align=center>".$odds_info[$i]["horsename"]."</td>";
                echo "<td align=right>".$actual_odds."</td>";
                for ($j=0;$j<$max_j;$j++) {
                    if ($umabans[$j] == $odds_info[$i]["umaban"]) {
                        $exp = $actual_odds*floatval($win_rates[$j])/100;
                        $memo = "";
                        $cost = intval($exp*(self::DIVIDEND_CRITERIA/100) / $actual_odds)*100+100;
                        // 無条件期待値0.8以上、または高オッズのため少額で期待値0.4以上をカバーできる馬は買い
                        if ($exp >= 0.8 || $exp*100/$actual_odds <= 1.5 && $exp >= 0.4) {
                            $memo = "☆☆";
                            $win_criteria += floatval($win_rates[$j]);
                            $exp_dividend += $actual_odds*$cost*(floatval($win_rates[$j])/100);
                            $auto_buy_array['umaban'][] = $odds_info[$i]['umaban'];
                            $auto_buy_array['buy'][] = $cost/100;
                        } else {
                            $cost = 0;
                            // 買うと不幸になるレースを排除(惜しい期待値で買ってないし来る確率が高い馬がたくさんいる場合)
                            if ($exp >= 0.55 && $exp < 0.8 && $actual_odds < 6) {
                                $bad_exp_count += 1;
                            }
                        }
                        $total_cost += $cost;
                        echo "<td align=right>".$win_rates[$j]."</td>";
                        echo "<td align=right>".sprintf("%.2f", $exp)."</td>";
                        echo "<td align=center>".$memo."</td>";
                        echo "<td align=right>".$cost."</td>";
                        break;
                    }
                }
            }
            echo "</tr>";
        }
        $judge = $this->is_pass_buyable_criteria($exp_dividend, $total_cost, $win_criteria, $bad_exp_count);
        echo "</table><br>";
        echo "勝率：".sprintf("%.1f",$win_criteria)."％<br>";
        echo "コスト：".$total_cost."<br>";
        echo "期待値：".round($exp_dividend,0)."<br>";
        echo "人気で期待値が惜しい馬：".$bad_exp_count."頭<br>";
        echo "購入判定：".$judge."<br>";
        if ($judge == "NG") {
            unset($auto_buy_array['umaban']);
            unset($auto_buy_array['buy']);
        }
        $json = json_encode($auto_buy_array);
        file_put_contents(self::DOWNLOAD_PATH."auto_buy.json", $json);
        $command="python3 ".self::DOWNLOAD_PATH."auto_buy.py ";
        exec($command,$output);
    }
    // 購入基準を満たす場合trueを返す
    // コストが安く(配当想定の0.8倍以下)、配当期待値が高いこと(期待値/コスト>=1.1)
    // 勝率が40.0%以上であるか、コストが期待の1/3未満であること
    private function is_pass_buyable_criteria($exp_dividend, $total_cost, $win_criteria, $bad_exp_count) {
        if ($total_cost <= self::DIVIDEND_CRITERIA*0.8 && $exp_dividend/$total_cost >= 1.1 && ($win_criteria >= 40.0 || $win_criteria >= 30.0 && $total_cost < self::DIVIDEND_CRITERIA/2) && $bad_exp_count < 2) {
            return "OK";
        } else {
            return "NG";
        }
    }
}
