<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientesFormRequest;
use App\Models\clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class ClienteController extends Controller
{
    public function store(ClientesFormRequest $request)
    {
        $clientes = clientes::create([
            'name' => $request->name,
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
            'password' => Hash::make($request->password),

        ]);

        return response()->json([
            "success" => true,
            "message" => "Cliente Cadastrado com sucesso",
            "data" => $clientes
        ], 200);
    }

    public function retornarTodos()
    {
        $clientes = clientes::all();
        return response()->json([
            'status' => true,
            'data' => $clientes
        ]);
    }

    public function pesquisarPorId($id)
    {
        $clientes = clientes::find($id);

        if ($clientes == null) {
            return response()->json([
                'status' => false,
                'message' => "cliente não encontrado"
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $clientes
        ]);
    }

    public function pesquisarPorname(Request $request)
    {
        $clientes = clientes::where('name', 'like', '%' . $request->name . '%')->get();

        if (count($clientes) > 0) {
            return response()->json([
                'status' => true,
                'data' => $clientes
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há resultados para a pesquisa.'
        ]);
    }


    public function pesquisarPorCpf(Request $request)
    {
        $clientes = clientes::where('cpf', 'like', '%' . $request->cpf . '%')->get();

        if (count($clientes) > 0) {
            return response()->json([
                'status' => true,
                'data' => $clientes
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function pesquisarPorCelular(Request $request)
    {
        $clientes = clientes::where('celular', 'like', '%' . $request->celular . '%')->get();

        if (count($clientes) > 0) {
            return response()->json([
                'status' => true,
                'data' => $clientes
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há resultados para a pesquisa.'
        ]);
    }


    public function pesquisarPorEmail(Request $request)
    {
        $clientes = clientes::where('email', 'like', '%' . $request->email . '%')->get();

        if (count($clientes) > 0) {
            return response()->json([
                'status' => true,
                'data' => $clientes
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há resultados para a pesquisa.'
        ]);
    }


    public function update(Request $request)
    {
        $cliente = clientes::find($request->id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encontrado"
            ]);
        }

        if (isset($request->name)) {
            $cliente->name = $request->name;
        }
        if (isset($request->celular)) {
            $cliente->celular = $request->celular;
        }
        if (isset($request->email)) {
            $cliente->email = $request->email;
        }
        if (isset($request->cpf)) {
            $cliente->cpf = $request->cpf;
        }
        if (isset($request->dataNascimento)) {
            $cliente->dataNascimento = $request->dataNascimento;
        }
        if (isset($request->cidade)) {
            $cliente->cidade = $request->cidade;
        }
        if (isset($request->estado)) {
            $cliente->estado = $request->estado;
        }
        if (isset($request->pais)) {
            $cliente->pais = $request->pais;
        }
        if (isset($request->rua)) {
            $cliente->rua = $request->rua;
        }
        if (isset($request->numero)) {
            $cliente->numero = $request->numero;
        }
        if (isset($request->bairro)) {
            $cliente->bairro = $request->bairro;
        }
        if (isset($request->cep)) {
            $cliente->cep = $request->cep;
        }
        if (isset($request->complemento)) {
            $cliente->complemento = $request->complemento;
        }
        if (isset($request->password)) {
            $cliente->password = $request->password;
        }

        $cliente->update();

        return response()->json([
            'status' => true,
            'message' => "Cadastro atualizado"
        ]);
    }


    public function excluir($id)
    {
        $cliente = clientes::find($id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encotrado"
            ]);
        }

        $cliente->delete();

        return response()->json([
            'status' => true,
            'message' => "Cadastro excluido com sucesso"
        ]);
    }

    public function esquecipassword(Request $request)
    {
        $cliente = clientes::where('cpf', '=', $request->cpf)->first();


        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encontrado"
            ]);
        }

        $cliente->password = Hash::make($cliente->cpf);

        $cliente->update();

        return response()->json([
            'status' => true,
            'message' => "Cadastro atualizado"
        ]);
    }

    public function exportarCsv()
    {
        $clientes = clientes::all();

        $nameArquivo = 'clientes.csv';

        $filePath = storage_path('app/public/' . $nameArquivo);

        $handle = fopen($filePath, "w");

        fputcsv($handle, array('name', 'E-mail', 'cpf', 'celular',), ';');

        foreach ($clientes as $u) {
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

    public function esquecipasswordCliente(Request $request)
    {
        $cliente = clientes::where('cpf', $request->cpf)->where('email', $request->email)->first();

        if (isset($cliente)) {
            $cliente->password = Hash::make($cliente->password);
            $cliente->update();
            return response()->json([
                'status' => true,
                'message' => 'password redefinida.'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'não foi possivel alterar a password'
        ]);
    }
}
