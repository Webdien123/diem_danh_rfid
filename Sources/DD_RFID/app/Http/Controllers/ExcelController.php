<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ExcelController extends Controller
{
    public function ImportFile()
    {
        $path = Input::file('im_file')->getRealPath();
        $data = Excel::load($path, function($reader) {})->get();
        echo $path;
        // echo "Tên bảng: ".$Import->tenBang."</br>";
        // echo "Tên file: ".$Import->im_file;
    }
}
