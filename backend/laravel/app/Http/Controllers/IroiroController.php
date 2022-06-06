<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// クエリビルダ用
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IroiroController extends Controller
{
    //
    public function query_sample(){
        $sample = DB::table('sample')->get();
        return view('query_sample',['sample'=>$sample]);
    }
}
