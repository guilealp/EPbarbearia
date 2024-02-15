<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissionalFormRequest;
use App\Models\profissional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class ProfissionalController extends Controller
{
    public function store(ProfissionalFormRequest $request)
    {
        $profissional = profissional::create([
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
            'salario' => $request->salario,

        ]);

        return response()->json([
            "succes" => true,
            "message" => "Profissional Cadastrado com sucesso",
            "data" => $profissional
        ], 200);
    }

    public function retornarTodos()
    {
        $profissional = profissional::all();
        return response()->json([
            'status' => true,
            'data' => $profissional
        ]);
    }

    public function pesquisarPorId($id)
    {
        $profissional = profissional::find($id);

        if ($profissional == null) {
            return response()->json([
                'status' => false,
                'message' => "profissional não encontrado"
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $profissional
        ]);
    }
    public function pesquisarPorname(Request $request)
    {
        $profissional = profissional::where('name', 'like', '%' . $request->name . '%')->get();

        if (count($profissional) > 0) {
            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há resultados para a pesquisa.'
        ]);
    }


    public function pesquisarPorCpf(Request $request)
    {
        $profissional = profissional::where('cpf', 'like', '%' . $request->cpf . '%')->get();

        if (count($profissional) > 0) {
            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function pesquisarPorCelular(Request $request)
    {
        $profissional = profissional::where('celular', 'like', '%' . $request->celular . '%')->get();

        if (count($profissional) > 0) {
            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há resultados para a pesquisa.'
        ]);
    }


    public function pesquisarPorEmail(Request $request)
    {
        $profissional = profissional::where('email', 'like', '%' . $request->email . '%')->get();

        if (count($profissional) > 0) {
            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function update(Request $request)
    {
        $profissional = profissional::find($request->id);

        if (!isset($profissional)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encontrado"
            ]);
        }

        if (isset($request->name)) {
            $profissional->name = $request->name;
        }
        if (isset($request->celular)) {
            $profissional->celular = $request->celular;
        }
        if (isset($request->email)) {
            $profissional->email = $request->email;
        }
        if (isset($request->cpf)) {
            $profissional->cpf = $request->cpf;
        }
        if (isset($request->dataNascimento)) {
            $profissional->dataNascimento = $request->dataNascimento;
        }
        if (isset($request->cidade)) {
            $profissional->cidade = $request->cidade;
        }
        if (isset($request->estado)) {
            $profissional->estado = $request->estado;
        }
        if (isset($request->pais)) {
            $profissional->pais = $request->pais;
        }
        if (isset($request->rua)) {
            $profissional->rua = $request->rua;
        }
        if (isset($request->numero)) {
            $profissional->numero = $request->numero;
        }
        if (isset($request->bairro)) {
            $profissional->bairro = $request->bairro;
        }
        if (isset($request->cep)) {
            $profissional->cep = $request->cep;
        }
        if (isset($request->complemento)) {
            $profissional->complemento = $request->complemento;
        }
        if (isset($request->password)) {
            $profissional->password = $request->password;
        }
        if (isset($request->salario)) {
            $profissional->salario = $request->salario;
        }
        $profissional->update();

        return response()->json([
            'status' => true,
            'message' => "Cadastro atualizado"
        ]);
    }


    public function excluir($id)
    {
        $profissional = profissional::find($id);

        if (!isset($profissional)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encotrado"
            ]);
        }

        $profissional->delete();

        return response()->json([
            'status' => true,
            'message' => "Cadastro excluido com sucesso"
        ]);
    }

    public function exportarCsv()
    {
        $profissionals = profissional::all();

        $nameArquivo = 'profissionals.csv';

        $filePath = storage_path('app/public/' . $nameArquivo);

        $handle = fopen($filePath, "w");

        fputcsv($handle, array('name', 'E-mail', 'cpf', 'celular',), ';');

        foreach ($profissionals as $u) {
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

    public function esquecipassword(Request $request)
    {
        $profissional = profissional::where('email', $request->email)->first();


        if (!isset($profissional)) {
            return response()->json([
                'status' => false,
                'message' => "Email invalido"

            ]);
        }

        if (isset($profissional->cpf)) {
           
            $profissional->password = Hash::make( $profissional->cpf );
            
        }
        $profissional->update();

        return response()->json([
            'status' => true,
            'password' => $profissional->password
        ]);
    }
}
