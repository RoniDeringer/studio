<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Ui\Presets\React;

class ClienteController extends Controller
{
    public function index()
    {

        $clientes = Cliente::select(
            'cliente.id AS id_cliente',
            'cliente.observacao ',
            'user.id AS id_user',
            'user.nome',
            'user.cidade',
            'user.telefone ',
            'user.data_nascimento',
                
        )
            ->join('users', 'users.id', 'cliente.id_user')
            ->get();
        return view('pages.clientes', ['clientes' => $clientes]);
    }

    public function addCliente()
    {
        return view('pages.add-cliente');
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

    public function destroy($cliente)
    {
        $user = User::find($cliente);
        dd($user);

        //colocar soft delete em user para colocar soft delete em user e cliente

        //
    }

    public function edit($id_user) //fazer pra mandar o id do cliente 
    {
        $user = User::find($id_user);

        $user->data_nascimento =  date("d/m/Y", date_create_from_format("Y-m-d", $user->data_nascimento)->getTimestamp());

        $cliente = Cliente::where('id_user',$user->id)->first();


        return view('pages.edit-cliente', ['cliente' => $cliente, 'user'=> $user] );
    }
    public function update(Request $request, $id_user){
        dump($id_user);
        dd($request);
    }
}
