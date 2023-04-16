<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {

        $clientes = Cliente::select("*")
            ->join('users', 'users.id', 'cliente.id_user')
            ->get();
        return view('pages.clientes', ['clientes' => $clientes]);
    }

    public function update()
    {
            
        $user = request()->user();
        $attributes = request()->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required',
            'phone' => 'required|max:10',
            'about' => 'required:max:150',
            'location' => 'required'
        ]);

        auth()->user()->update($attributes);
        return back()->withStatus('Profile successfully updated.');
    
}
}
