<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Terceirizado;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::select(
            'funcionario.id AS id_funcionario',
            'users.id AS id_user',
            'users.nome AS nome',
            'funcionario.cargo AS cargo',
            'funcionario.foto AS foto',
            'users.cidade AS cidade',
            'users.data_nascimento AS data_nascimento',
        )
            ->join('users', 'users.id', 'funcionario.id_user')
            ->get();

        $count = 0;
        foreach ($funcionarios as $funcionario) {
            $atendimentos = Atendimento::select(
                DB::raw('SUM(atendimento.valor) as valor_total')
            )
                ->where('id_funcionario', $funcionario->id_funcionario)
                ->first();

            $total_atendimentos = Atendimento::where('id_funcionario', $funcionario->id_funcionario)
                ->count();
            $funcionarios[$count]->total_atendimentos = $total_atendimentos;
            $funcionarios[$count]->rendimento = $atendimentos->valor_total;
            $count++;
        }
        return view('pages.funcionario.funcionarios', ['funcionarios' => $funcionarios]);
    }

    public function addFuncionario()
    {
        return view('pages.funcionario.add-funcionario', ['cidades' => self::CIDADES]);
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

            $funcionario = new Funcionario();
            $funcionario->id_user = $user->id;
            $funcionario->cargo = $request->cargo;
            if (!$imagem = $this->formattingImage($request->file('foto'))) {
                return redirect()->back()->with(['type' => 'alert-danger', 'message' => 'Erro ao cadastrar funcionáro! Imagem inválida.']);
            }
            $funcionario->foto = $imagem;
            $funcionario->save();

            return redirect()->route('funcionarios')->with(['type' => 'alert-success', 'message' => 'Funcionario cadastrado com sucesso!']);
        } catch (Exception $ex) {
            Log::error('Erro ao criar funcionario: ' . $ex->getMessage());
            return back()->with(['type' => 'alert-danger', 'message' => 'Erro! Tente novamente mais tarde.']);
        }
    }

    public function edit($id_funcionario)
    {
        $funcionario = Funcionario::find($id_funcionario);
        $user = User::where('id', $funcionario->id_user)->first();
        $user->data_nascimento = date("d/m/Y", date_create_from_format("Y-m-d", $user->data_nascimento)->getTimestamp());
        //caso na tiver data selecionada?

        return view('pages.funcionario.edit-funcionario', ['funcionario' => $funcionario, 'user' => $user, 'cidades' => self::CIDADES]);
    }

    public function update(Request $request, $id_funcionario)
    {
        try {

            $funcionario = Funcionario::find($id_funcionario);
            $user = User::find($funcionario->id_user);

            $funcionario->cargo = $request->cargo;
            if (!$imagem = $this->formattingImage($request->file('foto'))) {
                return redirect()->back()->with(['type' => 'alert-danger', 'message' => 'Erro ao cadastrar funcionáro! Imagem inválida.']);
            }
            $funcionario->foto = $imagem;


            $user->nome = $request->nome;
            $user->telefone = str_replace(array("(", ")", " ", "-"), "", $request->telefone);
            $user->data_nascimento = (date('Y-m-d', strtotime($request->dt_nascimento)));
            $user->cidade = $request->cidade;

            $funcionario->save();
            $user->save();

            return redirect()->route('funcionarios')->with(['type' => 'alert-success', 'message' => 'Funcionário editado com sucesso.']);
        } catch (Exception $ex) {
            Log::error('Erro ao editar funcionario: ' . $ex->getMessage());
            return back()->with(['type' => 'alert-danger', 'message' => 'Erro! Tente novamente mais tarde.']);
        }
    }
}
