<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Terceirizado;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Ui\Presets\React;

class TerceirizadoController extends Controller
{
    public function index()
    {
        return view('pages.terceirizados');
    }

    public function addTerceirizado()
    {
        return view('pages.add-terceirizado', ['cidades' => self::CIDADES]);
    }

    public function store(Request $request)
    {
        try {
            $user = new User();
            $user->nome = $request->nome;
            $user->telefone = str_replace(array("(", ")", " ", "-"), "", $request->telefone);
            $user->cidade = $request->cidade;
            $user->data_nascimento = (date('Y-m-d', strtotime($request->dt_nascimento)));
            $user->save();

            $terceirizado = new Terceirizado();
            $terceirizado->id_user = $user->id;
            $terceirizado->funcao = $request->funcao;
            $terceirizado->observacao = $request->observacao;
            $terceirizado->foto = $request->foto;
            $terceirizado->save();

            return redirect()->route('terceirizados')->with(['type' => 'alert-success', 'message' => 'Terceirizado cadastrado com sucesso!']);
        } catch (Exception $ex) {
            Log::error('Erro ao criar terceirizado: ' . $ex->getMessage());
            return back()->with(['type' => 'alert-danger', 'message' => 'Erro! Tente novamente mais tarde.']);
        }
    }


}