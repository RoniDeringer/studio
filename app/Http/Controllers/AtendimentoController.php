<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Servico;
use App\Models\Terceirizado;
use Illuminate\Http\Request;

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
            'atendimento.servico as servico',
        )
            ->join('cliente AS cli', 'cli.id', 'atendimento.id_cliente')
            ->join('users AS user_cli', 'user_cli.id', 'cli.id_user')
            ->leftJoin('funcionario AS func', 'func.id', 'atendimento.id_funcionario')
            ->leftJoin('users AS user_func', 'func.id_user', 'user_func.id')
            ->leftJoin('terceirizado AS terc', 'terc.id', 'atendimento.id_terceirizado')
            ->leftJoin('users AS user_terc', 'terc.id_user', 'user_terc.id')
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
            'atendimento.servico as servico',
        )
            ->join('cliente AS cli', 'cli.id', 'atendimento.id_cliente')
            ->join('users AS user_cli', 'user_cli.id', 'cli.id_user')
            ->leftJoin('funcionario AS func', 'func.id', 'atendimento.id_funcionario')
            ->leftJoin('users AS user_func', 'func.id_user', 'user_func.id')
            ->leftJoin('terceirizado AS terc', 'terc.id', 'atendimento.id_terceirizado')
            ->leftJoin('users AS user_terc', 'terc.id_user', 'user_terc.id')
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
            'cliente.id_user AS id_user',
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
        dd($request);
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
