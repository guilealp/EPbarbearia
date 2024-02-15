<?php

namespace App\Http\Controllers;

use App\Http\Requests\admFormRequest;
use App\Models\Adm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdmController extends Controller
{
    public function cadastroAdm(admFormRequest $request)
    {
        try{
            $data = $request->all();

            $data['password'] = Hash::make($request->password);

            $response = Adm::create($data)->createToken($request->server('HTTP_USER_AGENT'))->plainTextToken;

            return response()->json([
                'status'=>'success',
                'message'=>"Admin cadastrato com sucesso",
                'token'=>$response
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status'=> false,
                'menssage'=> $th->getMessage()
            ],500);
        }
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

        if (isset($request->name)) {
            $adm->name = $request->name;
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
        if (isset($request->password)) {
            $adm->password = $request->password;
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

    public function esquecipasswordAdm(Request $request)
    {
        $adm = adm::where('email', $request->email)->first();


        if (!isset($adm)) {
            return response()->json([
                'status' => false,
                'message' => "Email invalido"

            ]);
        }

        if (isset($adm->cpf)) {
           
            $adm->password = Hash::make( $adm->cpf );
            
        }
        $adm->update();

        return response()->json([
            'status' => true,
            'password' => $adm->password
        ]);
    }
    public function login(Request $request){
        try{
            if(Auth::guard('adms')->attempt([
                'email'=> $request->email,
                'password'=>$request->password
            ])) {
                $user = Auth::guard('adms')->user();

                $token = $user->createToken($request->server('HTTP_USER_AGENT',
                ['adms']))->plainTextToken;

                return response()->json([
                    'status'=>'success',
                    'message'=>'Admin logado com sucesso',
                    'token'=>$token
                ]);
            }
            else{
                return response()->json([
                    'status'=> false,
                    'message'=>'credenciais incorretas'
                ]);
            }
        }
        catch(\Throwable $th){
            return response()->json([
                'status'=> false,
                'menssage'=> $th->getMessage()
            ],500);
        }
    }

   
}
