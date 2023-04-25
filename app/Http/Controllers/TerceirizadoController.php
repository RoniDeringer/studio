<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Cliente;
use App\Models\Terceirizado;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Ui\Presets\React;

class TerceirizadoController extends Controller
{
    public function index()
    {
        $terceirizados = Terceirizado::select(
            'terceirizado.id AS terceirizado_id',
            'users.id AS user_id',
            'terceirizado.funcao',
            'terceirizado.foto',
            'users.nome',
            'terceirizado.created_at'
        )
            ->join('users', 'users.id', 'terceirizado.id_user')
            ->get();

        $count = 0;
        foreach ($terceirizados as $terceirizado) {
            $atendimentos = Atendimento::select(
                DB::raw('SUM(atendimento.valor) as valor_total')
            )
                ->where('id_terceirizado', $terceirizado->terceirizado_id)
                ->first();

            $total_atendimentos = Atendimento::where('id_terceirizado', $terceirizado->terceirizado_id)
                ->count();
            $terceirizados[$count]->total_atendimentos = $total_atendimentos;
            $terceirizados[$count]->rendimento = $atendimentos->valor_total;
            $count++;
        }

        return view('pages.terceirizados',['terceirizados' => $terceirizados]);
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
