<?php

namespace App\Traits;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/**
 * Trait for site Direction
 */
Trait DirectionSiteTrait
{
    public static function getDirection(){
        $local = LaravelLocalization::getCurrentLocale();
        if ($local == "en") $side = "left";
        else $side = "right"; 
        return $side;
    }
}
