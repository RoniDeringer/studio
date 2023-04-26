<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const CIDADES = [
        'dona_emma' => 'Dona Emma',
        'presidente_getulio' => 'Presidente Getúlio',
        'ibirama' => 'Ibirama',
        'rio_do_sul' => 'Rio do Sul',
        'witmarsum' => 'Witmarsum',
        'vitor_meireles' => 'Vitor Meireles',
        'salete' => 'Salete',
        'apiuna' => 'Apiúna',
    ];
    
    public function formattingImage($file)
    {
        if (!$this->validateImage($file)) {
            return false;
        }
        if ($file->isValid()) {
            $name = $file->getClientOriginalName();
            $file->storeAs('public/imagens',  $name);
        } else {
            return false;
        }
        return $name;
    }

    public function validateImage($imagem)
    {
        $tamanhoMaximo = 8 * 1024 * 1024; // 8 MB em bytes
        $extensoesValidas = array('jpg', 'jpeg', 'png');

        if (!$imagem || !$imagem->isValid()) {
            return false; // não há arquivo ou o upload falhou
        }

        $extensao = $imagem->getClientOriginalExtension();
        if (!in_array($extensao, $extensoesValidas)) {
            return false; // extensão inválida
        }

        if ($imagem->getSize() > $tamanhoMaximo) {
            return false; // tamanho máximo excedido
        }

        return true; // arquivo válido
    }
}
