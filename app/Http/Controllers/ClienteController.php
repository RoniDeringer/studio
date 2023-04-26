<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Cliente;
use App\Models\User;
use Carbon\Carbon;
use Exception;
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
          'cliente.observacao AS observacao',
          'users.telefone AS telefone',
          'users.cidade AS cidade',
          'users.data_nascimento AS data_nascimento',
                
        )
            ->join('users', 'users.id', 'cliente.id_user')
            ->get();

        return view('pages.clientes', ['clientes' => $clientes]);
    }

    public function addCliente()
    {
        return view('pages.add-cliente', ['cidades' => self::CIDADES]);
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

    public function destroy($id_cliente)
    {
        try {
            $cliente = Cliente::find($id_cliente);
            $user = User::where('id', $cliente->id_user)->first();
            if ($cliente && $user) {
                // $cliente->delete();
                // $user->delete();
                return redirect()->back()->with(['type' => 'alert-success', 'message' => 'Cliente excluído com sucesso.']);
            }
            Log::error('Erro ao excluir cliente! Cliente ou User não encontrado.');
            return redirect()->back()->with(['type' => 'alert-danger', 'message' => 'Erro ao excluir cliente.']);
        } catch (Exception $ex) {
            Log::error('Erro ao excluir cliente! Erro: ' . $ex->getMessage());
            return redirect()->back()->with(['type' => 'alert-danger', 'message' => 'Erro ao excluir cliente!']);
        }
    }


    public function edit($id_cliente)
    {
        $cliente = Cliente::find($id_cliente);
        $user = User::where('id',$cliente->id_user)->first();
        $user->data_nascimento =  date("d/m/Y", date_create_from_format("Y-m-d", $user->data_nascimento)->getTimestamp());
        //caso na tiver data selecionada?


        return view('pages.edit-cliente', ['cliente' => $cliente, 'user'=> $user, 'cidades'=> self::CIDADES] );
    }
    
    public function update(Request $request, $id_cliente){
        try {
            $cliente = Cliente::find($id_cliente);
            $user = User::where('id', $cliente->id_user)->first();
            if ($cliente && $user) {
                $cliente->observacao = $request->observacao;
                $user->nome = $request->nome;
                $user->telefone = str_replace(array("(", ")", " ", "-"), "", $request->telefone);
                $user->cidade = $request->cidade;
                if($request->dt_nascimento){
                    $user->data_nascimento = (date('Y-m-d', strtotime($request->dt_nascimento)));
                }else{
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
    public function view($cliente_id){
        $cliente = Cliente::select(
            'cliente.id AS cliente_id',
            'users.id AS user_id',
            'users.nome',
            'users.telefone',
            'users.cidade',
            'users.ultimo_atendimento',
            'users.data_nascimento',
        )
        ->join('users', 'users.id', 'cliente.id_user')
        ->where('cliente.id', $cliente_id)
        ->first();

        $idade = (Carbon::createFromFormat('Y-m-d', $cliente->data_nascimento))->age;
        $cliente->idade = $idade;

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

        dump($cliente);
        dump($atendimentos);
        dd('fim');
        return view('pages.view-cliente',[
            'cliente' => $cliente,
            'atendimentos' => $atendimentos,
        ]);

    }
}
