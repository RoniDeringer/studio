<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Servico;
use App\Models\Terceirizado;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AtendimentoController extends Controller
{
    public function index()
    {
        $atendimentos = Atendimento::select(
            'atendimento.id',
            'user_cli.nome as nome_cli',
            'user_func.nome as nome_func',
            'user_terc.nome as nome_terc',
            'atendimento.data as data_atendimento',
            'atendimento.valor as valor',
            'servico.nome as servico',
        )
            ->join('cliente AS cli', 'cli.id', 'atendimento.id_cliente')
            ->join('users AS user_cli', 'user_cli.id', 'cli.id_user')
            ->leftJoin('funcionario AS func', 'func.id', 'atendimento.id_funcionario')
            ->leftJoin('users AS user_func', 'func.id_user', 'user_func.id')
            ->leftJoin('terceirizado AS terc', 'terc.id', 'atendimento.id_terceirizado')
            ->leftJoin('users AS user_terc', 'terc.id_user', 'user_terc.id')
            ->leftJoin('servico', 'servico.id', 'atendimento.servico')
            ->get();


        return view('pages.atendimentos', ['atendimentos' => $atendimentos]);
    }
    public function viewCliente($user)
    {

        $atendimentos = Atendimento::select(
            'atendimento.id',
            'user_cli.nome as nome_cli',
            'user_func.nome as nome_func',
            'user_terc.nome as nome_terc',
            'atendimento.data as data_atendimento',
            'atendimento.valor as valor',
            'servico.nome as servico',
        )
            ->join('cliente AS cli', 'cli.id', 'atendimento.id_cliente')
            ->join('users AS user_cli', 'user_cli.id', 'cli.id_user')
            ->leftJoin('funcionario AS func', 'func.id', 'atendimento.id_funcionario')
            ->leftJoin('users AS user_func', 'func.id_user', 'user_func.id')
            ->leftJoin('terceirizado AS terc', 'terc.id', 'atendimento.id_terceirizado')
            ->leftJoin('users AS user_terc', 'terc.id_user', 'user_terc.id')
            ->leftJoin('servico', 'servico.id', 'atendimento.servico')
            ->where('user_cli.id', $user)
            ->get();


        return view('pages.atendimentos', ['atendimentos' => $atendimentos]);
    }

    public function addAtendimento()
    {

        $funcionarios = Funcionario::select(
            'funcionario.id_user AS id_user',
            'users.nome AS nome'
        )
            ->join('users', 'users.id', 'funcionario.id_user')
            ->get();

        $terceirizados = Terceirizado::select(
            'terceirizado.id_user AS id_user',
            'users.nome AS nome'
        )
            ->join('users', 'users.id', 'terceirizado.id_user')
            ->get();

        $clientes = Cliente::select(
            'cliente.id',
            'users.nome AS nome'
        )
            ->join('users', 'users.id', 'cliente.id_user')
            ->get();

        $servicos = Servico::select("id", "nome")->get();

        $data = [
            'dataAtual' => date("d/m/Y"),
            'profissionais' => array_merge($funcionarios->toArray(), $terceirizados->toArray()),
            'clientes' => $clientes->toArray(),
            'servicos' => $servicos->toArray(),
        ];

        return view('pages.add-atendimento', ['data' => $data]);
    }

    public function store(Request $request)
    {
        try {
            $atendimento = new Atendimento();
            $atendimento->id_cliente = $request->cliente_id;
            $atendimento->data = DateTime::createFromFormat('d/m/Y', $request->data);
            $atendimento->valor = floatval(str_replace(',', '.', $request->valor));
            $atendimento->servico = $request->servico_id;
            $atendimento->observacao = $request->observacao;

            if ($funcionario = Funcionario::where('id_user', $request->profissional_id)->first()) {
                $atendimento->id_funcionario = $funcionario->id;
            } else {
                $terceirizado = Terceirizado::where('id_user', $request->profissional_id)->first();
                $atendimento->id_terceirizado = $terceirizado->id;
            }

            $cliente = Cliente::find($request->cliente_id);
            $cliente->ultimo_atendimento = DateTime::createFromFormat('d/m/Y', $request->data);

            $atendimento->save();
            $cliente->save();

            return redirect()->route('atendimentos')->with(['type' => 'alert-success', 'message' => 'Atendimento cadastrado com sucesso!']);
        } catch (Exception $ex) {
            Log::error('Erro ao criar atendimento: ' . $ex->getMessage());
            return back()->with(['type' => 'alert-danger', 'message' => 'Erro! Tente novamente mais tarde.']);
        }
    }

    public function view($atendimento){

        return view('pages.view-atendimento');


    }

    public function update()
    {
        // $user = request()->user();
        // $attributes = request()->validate([
        //     'email' => 'required|email|unique:users,email,' . $user->id,
        //     'name' => 'required',
        //     'phone' => 'required|max:10',
        //     'about' => 'required:max:150',
        //     'location' => 'required'
        // ]);

        // auth()->user()->update($attributes);
        // return back()->withStatus('Profile successfully updated.');
    }
}
