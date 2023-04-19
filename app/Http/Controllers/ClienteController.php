<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    public function index()
    {

        $clientes = Cliente::select("*")
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
            $user->data_nascimento = $request->dt_nascimento;
            $user->save();
            
            return back()->with(['type' => 'alert-success', 'message' => 'Usuário cadastrado com sucesso!', 'response' => $this->createJson(201, 'Usuário criado com sucesso.')]);
        } catch (Exception $ex) {
            Log::error('Erro ao criar usuário: ' . $ex->getMessage());
            return back()->with(['type' => 'alert-danger', 'message' => 'Erro! Tente novamente mais tarde.', 'response' => $this->createJson(500, 'Erro na inserção de usuário.')]);
        }
    }

    public function update()
    {
        //        
    }
}
