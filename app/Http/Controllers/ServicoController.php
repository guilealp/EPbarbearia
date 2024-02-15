<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoFormRequest;
use App\Models\servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class ServicoController extends Controller
{
    public function store(Request $request)
    {
        $servicos = servico::create([
            'name' => $request->name,
            'descricao' => $request->descricao,
            'duracao' => $request->duracao,
            'preco' => $request->preco,
            'name_profissional'=>$request->name_profissional
        ]);

        return response()->json([
            "succes" => true,
            "message" => "Serviço Cadastrado com sucesso",
            "data" => $servicos
        ], 200);
    }

    public function retornarTodos()
    {
        $servicos = servico::all();
        return response()->json([
            'status' => true,
            'data' => $servicos
        ]);
    }

    public function pesquisarPorId($id)
    {
        $servicos = servico::find($id);

        if ($servicos == null) {
            return response()->json([
                'status' => false,
                'message' => "serviço não encontrado"
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $servicos
        ]);
    }

    public function pesquisarPorname(Request $request)
    {
        $servicos = servico::where('name', 'like', '%' . $request->name . '%')->get();
        if (count($servicos) > 0) {
            return response()->json([
                'status' => true,
                'data' => $servicos
            ]);
        }


        return response()->json([
            'status' => false,
            'message' => "Não há resultados para pesquisar"
        ]);
    }


    public function pesquisarPorDescricao(Request $request)
    {
        $servicos = servico::where('descricao', 'like', '%' . $request->descricao . '%')->get();

        if (count($servicos) > 0) {
            return response()->json([
                'status' => true,
                'data' => $servicos
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function update(Request $request)
    {
        $servicos = servico::find($request->id);

        if (!isset($servicos)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encontrado"
            ]);
        }

        if (isset($request->name)) {
            $servicos->name = $request->name;
        }
        if (isset($request->descricao)) {
            $servicos->descricao = $request->descricao;
        }
        if (isset($request->duracao)) {
            $servicos->duracao = $request->duracao;
        }
        if (isset($request->preco)) {
            $servicos->preco = $request->preco;
        }

        $servicos->update();

        return response()->json([
            'status' => true,
            'message' => "Cadastro atualizado"
        ]);
    }

    public function excluir($id)
    {
        $servicos = servico::find($id);

        if (!isset($servicos)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encotrado"
            ]);
        }

        $servicos->delete();

        return response()->json([
            'status' => true,
            'message' => "Cadastro excluido com sucesso"
        ]);
    }

    public function exportarCsv()
    {
        $servicos = servico::all();

        $nameArquivo = 'servicos.csv';

        $filePath = storage_path('app/public/' . $nameArquivo);

        $handle = fopen($filePath, "w");

        fputcsv($handle, array('name', 'E-mail', 'cpf', 'celular',), ';');

        foreach ($servicos as $u) {
            fputcsv($handle, array(
                $u->name,
                $u->email,
                $u->cpf,
                $u->celular,

            ), ';');
        }

        fclose($handle);

        return Response::download(public_path() . '/storage/' . $nameArquivo)
            ->deleteFileAfterSend(true);
    }
}
