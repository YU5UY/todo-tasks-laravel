<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\DirectionSiteTrait;


class landingController extends Controller
{
    //
    use DirectionSiteTrait;
    public function index()
    {
        $side = $this->getdirection();
        return view("welcome")
            ->with(["direction" => $side]);
        
    }
}
