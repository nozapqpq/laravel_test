<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageAbstructController extends Controller
{
    public function index() {
        return view('page_abstruct');
    }

    public function routing() {
        return view('page_routing');
    }

    public function request() {
        return view('page_request');
    }

    public function query_builder() {
        return view('page_query_builder');
    }

    public function orm() {
        return view('orm');
    }

    public function di() {
        return view('di');
    }

    public function cert() {
        return view('cert');
    }

    public function test() {
        return view('test');
    }

    public function artisan() {
        return view('artisan');
    }


}
