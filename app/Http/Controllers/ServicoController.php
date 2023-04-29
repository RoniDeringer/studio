<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
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
    public function destroy($id)
    {
        try {
            $servico = Servico::findOrFail($id);
            $servico->delete();
            return response()->json('Serviço excluído com sucesso', 200);
        } catch (QueryException $ex) {
            return response()->json($ex->getMessage(), 204);
        }
    }
}
