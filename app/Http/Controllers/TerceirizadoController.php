<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Cliente;
use App\Models\Terceirizado;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Ui\Presets\React;

class TerceirizadoController extends Controller
{
    public function index()
    {
        $terceirizados = Terceirizado::select(
            'terceirizado.id AS terceirizado_id',
            'users.id AS user_id',
            'terceirizado.funcao',
            'terceirizado.foto',
            'users.nome',
            'terceirizado.created_at'
        )
            ->join('users', 'users.id', 'terceirizado.id_user')
            ->get();

        $count = 0;
        foreach ($terceirizados as $terceirizado) {
            $atendimentos = Atendimento::select(
                DB::raw('SUM(atendimento.valor) as valor_total')
            )
                ->where('id_terceirizado', $terceirizado->terceirizado_id)
                ->first();

            $total_atendimentos = Atendimento::where('id_terceirizado', $terceirizado->terceirizado_id)
                ->count();
            $terceirizados[$count]->total_atendimentos = $total_atendimentos;
            $terceirizados[$count]->rendimento = $atendimentos->valor_total;
            $count++;
        }

        return view('pages.terceirizado.terceirizados',['terceirizados' => $terceirizados]);
    }

    public function addTerceirizado()
    {
        return view('pages.add-terceirizado', ['cidades' => self::CIDADES]);
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

            $terceirizado = new Terceirizado();
            $terceirizado->id_user = $user->id;
            $terceirizado->funcao = $request->funcao;
            $terceirizado->observacao = $request->observacao;
            $terceirizado->foto = $request->foto;
            $terceirizado->save();

            return redirect()->route('terceirizados')->with(['type' => 'alert-success', 'message' => 'Terceirizado cadastrado com sucesso!']);
        } catch (Exception $ex) {
            Log::error('Erro ao criar terceirizado: ' . $ex->getMessage());
            return back()->with(['type' => 'alert-danger', 'message' => 'Erro! Tente novamente mais tarde.']);
        }
    }


    public function edit($id_terceirizado){
        
        $terceirizado = Terceirizado::find($id_terceirizado);
        $user = User::where('id', $terceirizado->id_user)->first();
        $user->data_nascimento =  date("d/m/Y", date_create_from_format("Y-m-d", $user->data_nascimento)->getTimestamp());
        //caso na tiver data selecionada?

        return view('pages.terceirizado.edit-terceirizado', ['terceirizado' => $terceirizado, 'user'=> $user, 'cidades'=>self::CIDADES] );
    }

    public function update (Request $request, $id_terceirizado){
        try {
            $terceirizado = Terceirizado::find($id_terceirizado);
            $user = User::find($terceirizado->id_user);

            $terceirizado->observacao = $request->observacao;
            $terceirizado->funcao = $request->funcao;
            if($request->file('foto')){
                if (!$imagem = $this->formattingImage($request->file('foto'))) {
                    return redirect()->back()->with(['type' => 'alert-danger', 'message' => 'Erro ao cadastrar terceirizado! Imagem inválida.']);
                }
                $terceirizado->foto = $imagem;
            }

            $user->nome = $request->nome;
            $user->telefone = str_replace(array("(", ")", " ", "-"), "", $request->telefone);
            $user->data_nascimento = (date('Y-m-d', strtotime($request->dt_nascimento)));
            $user->cidade = $request->cidade;

            $terceirizado->save();
            $user->save();

            return redirect()->route('terceirizados')->with(['type' => 'alert-success', 'message' => 'Terceirizado editado com sucesso.']);
        } catch (Exception $ex) {
            Log::error('Erro ao editar terceirizado: ' . $ex->getMessage());
            return back()->with(['type' => 'alert-danger', 'message' => 'Erro! Tente novamente mais tarde.']);
        }
    }

    public function destroy($id){
        try {
            $terceirizado = Terceirizado::findOrFail($id);
            $terceirizado->delete();
            return response()->json('Terceirizado excluído com sucesso', 200);
        } catch (QueryException $ex) {
            return response()->json($ex->getMessage(), 204);
        }
    }
}
