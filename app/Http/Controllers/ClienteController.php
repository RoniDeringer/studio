<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Cliente;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Ui\Presets\React;

class ClienteController extends Controller
{
    public function index()
    {

        $clientes = Cliente::select(
            'cliente.id AS id_cliente',
            'users.id AS id_user',
            'users.nome AS nome',
            'cliente.ultimo_atendimento',
            'users.cidade',
        )
            ->join('users', 'users.id', 'cliente.id_user')
            ->get();

        $count = count($clientes);
        for ($i = 0; $i < $count; $i++) {

            $atendimentos = Atendimento::select(
                DB::raw('SUM(atendimento.valor) as valor_total')
            )
                ->where('atendimento.id_cliente', $clientes[$i]->id_cliente)
                ->first();
            $clientes[$i]->total_gasto = $atendimentos->valor_total;
        }

        return view('pages.cliente.clientes', ['clientes' => $clientes]);
    }

    public function addCliente()
    {
        return view('pages.cliente.add-cliente', ['cidades' => self::CIDADES]);
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

            $cliente = new Cliente();
            $cliente->id_user = $user->id;
            $cliente->observacao = $request->observacao;
            $cliente->save();

            return redirect()->route('clientes')->with(['type' => 'alert-success', 'message' => 'Cliente cadastrado com sucesso!']);
        } catch (Exception $ex) {
            Log::error('Erro ao criar cliente: ' . $ex->getMessage());
            return back()->with(['type' => 'alert-danger', 'message' => 'Erro! Tente novamente mais tarde.']);
        }
    }

    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $user = User::findOrFail($cliente->id_user);
            if ($cliente && $user) {
                $cliente->delete();
                $user->delete();
                return response()->json('Cliente excluído com sucesso', 200);
            }
        } catch (QueryException $ex) {
            return response()->json($ex->getMessage(), 204);
        }
    }


    public function edit($id_cliente)
    {
        $cliente = Cliente::find($id_cliente);
        $user = User::where('id', $cliente->id_user)->first();
        $user->data_nascimento =  date("d/m/Y", date_create_from_format("Y-m-d", $user->data_nascimento)->getTimestamp());
        //caso na tiver data selecionada?


        return view('pages.cliente.edit-cliente', ['cliente' => $cliente, 'user' => $user, 'cidades' => self::CIDADES]);
    }

    public function update(Request $request, $id_cliente)
    {
        try {
            $cliente = Cliente::find($id_cliente);
            $user = User::where('id', $cliente->id_user)->first();
            if ($cliente && $user) {
                $cliente->observacao = $request->observacao;
                $user->nome = $request->nome;
                $user->telefone = str_replace(array("(", ")", " ", "-"), "", $request->telefone);
                $user->cidade = $request->cidade;
                if ($request->dt_nascimento) {
                    $user->data_nascimento = (date('Y-m-d', strtotime($request->dt_nascimento)));
                } else {
                    $user->data_nascimento = NULL;
                }

                $user->save();
                $cliente->save();

                return redirect()->route('clientes')->with(['type' => 'alert-success', 'message' => 'Dados do Cliente atualizado com sucesso!.']);
            }
            Log::error('Erro ao atualizar cliente! Cliente ou User não encontrado.');
            return redirect()->route('clientes')->with(['type' => 'alert-danger', 'message' => 'Erro ao atualizar dados do cliente!.']);
        } catch (Exception $ex) {
            Log::error('Erro ao atualizar cliente! Erro: ' . $ex->getMessage());
            return redirect()->route('clientes')->with(['type' => 'alert-danger', 'message' => 'Erro ao atualizar cliente!']);
        }
    }
    public function view($cliente_id)
    {
        $cliente = Cliente::select(
            'cliente.id AS cliente_id',
            'users.id AS user_id',
            'users.nome',
            'users.telefone',
            'users.cidade',
            'cliente.ultimo_atendimento',
            'cliente.observacao',
            'users.data_nascimento',
        )
            ->join('users', 'users.id', 'cliente.id_user')
            ->where('cliente.id', $cliente_id)
            ->first();
        if ($cliente->data_nascimento) {
            $idade = (Carbon::createFromFormat('Y-m-d', $cliente->data_nascimento))->age;
            $cliente->idade = $idade;
            $cliente->dt_nascimento = Carbon::parse($cliente->data_nascimento)->format('d/m/Y');
        }
        $atendimentos = Atendimento::select(
            DB::raw('SUM(atendimento.valor) as valor_total')
        )
            ->join('cliente', 'cliente.id', 'atendimento.id_cliente')
            ->where('cliente.id', $cliente_id)
            ->first();

        $total_atendimentos = Atendimento::join('cliente', 'cliente.id', 'atendimento.id_cliente')
            ->where('cliente.id', $cliente_id)
            ->count();
        $atendimentos->total_atendimentos = $total_atendimentos;

        $ultimosAtendimentos = Atendimento::select(
            'atendimento.valor',
            DB::raw('DATE_FORMAT(atendimento.data, "%d/%m/%Y") as data'),
            'atendimento.id AS id_atendimento',
            'servico.nome AS servico',
        )
            ->join('servico', 'servico.id', 'atendimento.servico')
            ->where('atendimento.id_cliente', $cliente_id)
            ->orderBy('data', 'desc')
            ->limit(5)
            ->get();

            return view('pages.cliente.view-cliente', [
            'cliente' => $cliente,
            'atendimentos' => $atendimentos,
            'ultimosAtendimentos' => $ultimosAtendimentos,
        ]);
    }
}
