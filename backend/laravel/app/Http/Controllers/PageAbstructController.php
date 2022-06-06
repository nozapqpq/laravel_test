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
        return view('page_orm');
    }

    public function di() {
        return view('page_di');
    }

    public function cert() {
        return view('page_cert');
    }

    public function test() {
        return view('page_test');
    }

    public function artisan() {
        return view('page_artisan');
    }


}
