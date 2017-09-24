<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CanBo;
use App\To_BoMon;
use App\Khoa_Phong;

class CanBoController extends Controller
{
    public function GetPageCB()
    {
        $canbos = CanBo::GetCanBo();
        $bomons = To_BoMon::GetBoMon();
        $khoas = Khoa_Phong::GetKhoa();
        return view('sub_views.staff', [
                'canbos' => $canbos, 
                'bomons' => $bomons,
                'khoas' => $khoas
        ]);
    }
}
