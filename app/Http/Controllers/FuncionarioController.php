<?php

namespace App\Http\Controllers;

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
            DB::raw('SUM(atendimento.valor) AS total_valor')

        )
            ->join('users', 'users.id', 'funcionario.id_user')
            ->leftJoin('atendimento', 'atendimento.id_funcionario', 'funcionario.id')
            ->groupBy('funcionario.id', 'users.id', 'users.nome', 'funcionario.cargo', 'funcionario.foto',  'users.cidade', 'users.data_nascimento')
            ->get();
        return view('pages.funcionarios', ['funcionarios' => $funcionarios]);
    }

    public function addFuncionario()
    {
        return view('pages.add-funcionario', ['cidades' => self::CIDADES]);
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

    public function formattingImage($file)
    {
        if (!$this->validateImage($file)) {
            return false;
        }
        if ($file->isValid()) {
            $name = $file->getClientOriginalName();
            $file->storeAs('public/imagens',  $name);
        } else {
            return false;
        }
        return $name;
    }

    function validateImage($imagem)
    {
        $tamanhoMaximo = 8 * 1024 * 1024; // 8 MB em bytes
        $extensoesValidas = array('jpg', 'jpeg', 'png');

        if (!$imagem || !$imagem->isValid()) {
            return false; // não há arquivo ou o upload falhou
        }

        $extensao = $imagem->getClientOriginalExtension();
        if (!in_array($extensao, $extensoesValidas)) {
            return false; // extensão inválida
        }

        if ($imagem->getSize() > $tamanhoMaximo) {
            return false; // tamanho máximo excedido
        }

        return true; // arquivo válido
    }
}
