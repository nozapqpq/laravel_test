<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Goutte\Client;

use Symfony\Component\HttpClient\HttpClient;

class ScrapingController extends Controller
{
    /** * Display a listing of the source.
     * @return \Illuminate\Http\Response
    */
    public function netkeiba() {
        $client = new Client(HttpClient::create(['timeout' => 60]));

        $items = DB::table('kaisai')->where('year','=',2022)->where('month','=',1)->where('day','=',16)->get();
        foreach ($items as $item) {
            
            $getUrl = 'https://race.netkeiba.com/race/shutuba.html?race_id='.$item->race_id.'01';
            print $getUrl ."<br>";
            $crawler = $client->request('GET', $getUrl);

            $crawler->filter('td.HorseInfo')->each(function($node) use (&$ix, &$horsename) {
                $horsename[$ix] = $node->text();
                $ix++;
            });
            $crawler->filter('td.Weight')->each(function($node) use (&$ix, &$weight) {
                $weight[$ix] = $node->text();
                $ix++;
            });
            $crawler->filter('td.Jockey')->each(function($node) use (&$ix, &$jockey) {
                $jockey[$ix] = $node->text();
                $ix++;
            });
            $crawler->filter('td.Trainer')->each(function($node) use (&$ix, &$trainer) {
                $trainer[$ix] = $node->text();
                $ix++;
            });
        }
        /*
        foreach ($horsename as $t => $w) {
            print $w. "<br>";
        }
        foreach ($weight as $t => $w) {
            print $w. "<br>";
        }
        foreach ($jockey as $t => $w) {
            print $w. "<br>";
        }
        foreach ($trainer as $t => $w) {
            print $w. "<br>";
        }
        */
    }
}
