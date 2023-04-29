<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Servico;
use App\Models\Terceirizado;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServicoController extends Controller
{
    public function index()
    {
        return view('pages.servico.servicos', ['servicos' =>  Servico::all()]);
    }

    public function store(Request $request)
    {
        try {
            $servico = new Servico();
            $servico->nome = $request->valor;
            $servico->save();
            return response()->json('Serviço salvo com sucesso', 200);
        } catch (QueryException $ex) {
            return response()->json($ex->getMessage(), 204);
        }
    }
}
