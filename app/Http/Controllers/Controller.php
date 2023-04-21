<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    CONST CIDADES = [
        'dona_emma' => 'Dona Emma',
        'presidente_getulio' => 'Presidente Getúlio',
        'ibirama' => 'Ibirama',
        'rio_do_sul' => 'Rio do Sul',
        'witmarsum' => 'Witmarsum',
        'vitor_meireles' => 'Vitor Meireles',
        'salete' => 'Salete',
        'apiuna' => 'Apiúna',
    ];

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
