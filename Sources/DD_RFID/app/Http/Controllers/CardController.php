<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    public function TestCard(Request $R)
    {
        echo $R->id_the;
    }
}
