<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;

class FormaDePagamentoController extends Controller
{
    public function store(Request $request)
    {
        $pagamentos = Pagamento::create([
            'nome_pagamento' => $request->nome_pagamento,
           
        ]);

        return response()->json([
            "succes" => true,
            "message" => "forma de pagamento Cadastrado com sucesso",
            "data" => $pagamentos
        ], 200);
    }

    public function excluir($id)
    {
        $pagamentos = Pagamento::find($id);

        if (!isset($pagamentos)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encotrado"
            ]);
        }

        $pagamentos->delete();

        return response()->json([
            'status' => true,
            'message' => "Cadastro excluido com sucesso"
        ]);
    }
    public function update(Request $request)
    {
        $pagamentos = Pagamento::find($request->id);

        if (!isset($pagamentos)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encontrado"
            ]);
        }

        if (isset($request->nome)) {
            $pagamentos->nome_pagamento = $request->nome_pagamento;
        }
        

        $pagamentos->update();

        return response()->json([
            'status' => true,
            'message' => "Cadastro atualizado"
        ]);
    }
}
