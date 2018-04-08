<?php

namespace App\Http\Controllers;


class AppHelperController extends Controller
{
    public static function limitarTexto($texto, $limite){

        $texto = str_limit($texto, $limite, '...');

        return $texto;
    }
}
