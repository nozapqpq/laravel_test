<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaisaiImportController extends Controller
{
    public function index(Request $request, KaisaiImportService $kaisai_service) {
        $kaisai_service->kaisaiImport($request);
    }
}
