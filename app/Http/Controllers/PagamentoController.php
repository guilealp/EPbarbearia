<?php

namespace App\Http\Controllers;

use App\Http\Requests\pagamentoFormRequest;
use App\Models\Pagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PagamentoController extends Controller
{
    public function store(pagamentoFormRequest $request)
    {
        $pagamento = Pagamento::create([
            'nome_pagamento' => $request->nome_pagamento,

        ]);

        return response()->json([
            "succes" => true,
            "message" => "Pagamento Cadastrado com sucesso",
            "data" => $pagamento
        ], 200);
    }
    public function excluir($id)
    {
        $pagamento = Pagamento::find($id);

        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => "pagamento não encotrado"
            ]);
        }

        $pagamento->delete();

        return response()->json([
            'status' => true,
            'message' => "pagamento excluido com sucesso"
        ]);
    }
    public function esqueciSenha(Request $request)
    {
        $pagamento = Pagamento::where('cpf', '=', $request->cpf)->where('email', '=', $request->email)->first();

        if (isset($pagamento)) {
            $pagamento->senha = Hash::make($pagamento->senha);
            $pagamento->update();
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
