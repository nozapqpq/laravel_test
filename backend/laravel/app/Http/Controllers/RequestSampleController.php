<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestSampleController extends Controller
{
    //
    public function request_post(Request $request) {
        $attributes = $request->only(['eval','comment']);
        return view('request_result',compact('attributes'));
    }
}
