<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function Error($mes, $re)
    {
        return view('orther_views.Error', ['mes' => $mes, 're' => $re]);
    }
}
