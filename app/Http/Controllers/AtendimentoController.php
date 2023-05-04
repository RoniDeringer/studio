<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Servico;
use App\Models\Terceirizado;
use Carbon\Carbon;
use DateTime;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
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


        return view('pages.atendimento.atendimentos', ['atendimentos' => $atendimentos]);
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


        return view('pages.atendimento.atendimentos', ['atendimentos' => $atendimentos]);
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

        return view('pages.atendimento.add-atendimento', ['data' => $data]);
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

    public function view($atendimento)
    {


        try {
            $atendimento = Atendimento::find($atendimento);

            if ($atendimento->data) {
                Carbon::setLocale('pt_BR');
                $date = Carbon::parse($atendimento->data);
                $atendimento->dataFormatada = $date->translatedFormat('F') . ': ' . $date->translatedFormat('l');
                $atendimento->data = Carbon::parse($atendimento->data)->format('d/m/Y');
            }

            $servico = Servico::find($atendimento->servico);

            $cliente = Cliente::select(
                'users.nome',
                'users.telefone',
                'users.cidade',
                'users.data_nascimento',
                'cliente.observacao',
            )
                ->join('users', 'users.id', 'cliente.id_user')
                ->where('cliente.id', $atendimento->id_cliente)
                ->first();

            if ($cliente->data_nascimento) {
                $idade = (Carbon::createFromFormat('Y-m-d', $cliente->data_nascimento))->age;
                $cliente->idade = $idade;
            }

            if ($atendimento->id_funcionario) {
                $funcionario = Funcionario::select(
                    'users.nome',
                    'users.telefone',
                    'users.cidade',
                    'users.data_nascimento',
                    'funcionario.cargo',
                    'funcionario.foto',
                )
                    ->join('users', 'users.id', 'funcionario.id_user')
                    ->where('funcionario.id', $atendimento->id_funcionario)
                    ->first();
                $terceirizado = [];
            } else {
                $terceirizado = Terceirizado::select(
                    'users.nome',
                    'users.telefone',
                    'users.cidade',
                    'users.data_nascimento',
                    'terceirizado.funcao',
                    'terceirizado.observacao',
                    'terceirizado.foto',
                )
                    ->join('users', 'users.id', 'terceirizado.id_user')
                    ->where('terceirizado.id', $atendimento->id_terceirizado)
                    ->first();
                $funcionario = [];
            }

            return view('pages.atendimento.view-atendimento')->with(
                [
                    'atendimento' => $atendimento,
                    'servico' => $servico,
                    'cliente' => $cliente,
                    'funcionario' => $funcionario,
                    'terceirizado' => $terceirizado,
                ]
            );
        } catch (Exception $ex) {
            Log::error('Não foi possível achar o atendimento: ' . $ex->getMessage());
            return back()->with(['type' => 'alert-danger', 'message' => 'Não foi possível achar o atendimento.']);
        }

        //cliente

        //profissional

        //atendimento / servico

        // return view('pages.atendimento.view-atendimento');
    }

    public function edit($id_atendimento)
    {
        $atendimento = Atendimento::find($id_atendimento);

        $funcionarios = Funcionario::select(
            'funcionario.id AS id_funcionario',
            'funcionario.id_user AS id_user',
            'users.nome AS nome',
            DB::raw('0 AS id_terceirizado')
        )
            ->join('users', 'users.id', 'funcionario.id_user')
            ->get();

        $terceirizados = Terceirizado::select(
            'terceirizado.id AS id_terceirizado',
            'terceirizado.id_user AS id_user',
            'users.nome AS nome',
            DB::raw('0 AS id_funcionario')
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

        return view('pages.atendimento.edit-atendimento', ['data' => $data, 'atendimento' => $atendimento]);
    }

    public function update(Request $request, $id_atendimento)
    {
        try {
            $atendimento = Atendimento::find($id_atendimento);
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

            //se essa a data fornecida for mais recente que do ultimo atendimento eu atualizo o registro
            if (DateTime::createFromFormat('d/m/Y', $request->data) > DateTime::createFromFormat('Y-m-d', $cliente->ultimo_atendimento)) {
                $cliente->ultimo_atendimento = DateTime::createFromFormat('d/m/Y', $request->data);
            }

            $atendimento->save();
            $cliente->save();

            return redirect()->route('atendimentos')->with(['type' => 'alert-success', 'message' => 'Atendimento editado com sucesso!']);
        } catch (Exception $ex) {
            Log::error('Erro ao editar atendimento: ' . $ex->getMessage());
            return back()->with(['type' => 'alert-danger', 'message' => 'Erro! Tente novamente mais tarde.']);
        }
    }
}
