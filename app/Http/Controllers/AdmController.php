<?php

namespace App\Http\Controllers;

use App\Http\Requests\admFormRequest;
use App\Models\Adm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdmController extends Controller
{
    public function cadastroAdm(admFormRequest $request)
    {
        $adm = adm::create([
            'nome' => $request->nome,
            'celular' => $request->celular,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'dataNascimento' => $request->dataNascimento,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'pais' => $request->pais,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cep' => $request->cep,
            'complemento' => $request->complemento,
            'senha' => Hash::make($request->senha),

        ]);

        return response()->json([
            "success" => true,
            "message" => "adm Cadastrado com sucesso",
            "data" => $adm
        ], 200);
    }

    public function retornarTodos()
    {
        $adm = Adm::all();
        return response()->json([
            'status' => true,
            'data' => $adm
        ]);
    }

    public function pesquisarPorId($id)
    {
        $adm = adm::find($id);

        if ($adm == null) {
            return response()->json([
                'status' => false,
                'message' => "adm não encontrado"
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $adm
        ]);
    }
    public function update(Request $request)
    {
        $adm = adm::find($request->id);

        if (!isset($adm)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encontrado"
            ]);
        }

        if (isset($request->nome)) {
            $adm->nome = $request->nome;
        }
        if (isset($request->celular)) {
            $adm->celular = $request->celular;
        }
        if (isset($request->email)) {
            $adm->email = $request->email;
        }
        if (isset($request->cpf)) {
            $adm->cpf = $request->cpf;
        }
        if (isset($request->dataNascimento)) {
            $adm->dataNascimento = $request->dataNascimento;
        }
        if (isset($request->cidade)) {
            $adm->cidade = $request->cidade;
        }
        if (isset($request->estado)) {
            $adm->estado = $request->estado;
        }
        if (isset($request->pais)) {
            $adm->pais = $request->pais;
        }
        if (isset($request->rua)) {
            $adm->rua = $request->rua;
        }
        if (isset($request->numero)) {
            $adm->numero = $request->numero;
        }
        if (isset($request->bairro)) {
            $adm->bairro = $request->bairro;
        }
        if (isset($request->cep)) {
            $adm->cep = $request->cep;
        }
        if (isset($request->complemento)) {
            $adm->complemento = $request->complemento;
        }
        if (isset($request->senha)) {
            $adm->senha = $request->senha;
        }

        $adm->update();

        return response()->json([
            'status' => true,
            'message' => "Cadastro atualizado"
        ]);
    }


    public function excluir($id)
    {
        $adm = adm::find($id);

        if (!isset($adm)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encotrado"
            ]);
        }

        $adm->delete();

        return response()->json([
            'status' => true,
            'message' => "Cadastro excluido com sucesso"
        ]);
    }

    public function esqueciSenhaAdm(Request $request)
    {
        $adm = adm::where('cpf', $request->cpf)->where('email', $request->email)->first();

        if (isset($adm)) {
            $adm->senha = Hash::make($adm->senha);
            $adm->update();
            return response()->json([
                'status' => true,
                'message' => 'senha redefinida.'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'não foi possivel alterar a senha'
        ]);
    }

   
}
