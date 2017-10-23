<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response;

class DiemDanhController extends Controller
{
    public function DiemDanhVao()
    {        
        if (Request::ajax()) {
            return response()->json($request->all());
        }
    }
}
