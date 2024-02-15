<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class admFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:120',
            'celular' => 'required|max:11|min:10',
            'email' => 'required|max:120|email|unique:clientes,email',
            'cpf' => 'required|max:11|min:11|unique:clientes,cpf',
            'dataNascimento' => 'required|date',
            'cidade' => 'required|max:120',
            'estado' => 'required|max:2|min:2',
            'pais' => 'required|max:80',
            'rua' => 'required|max:120',
            'numero' => 'required|max:10',
            'bairro' => 'required|max:100',
            'cep' => 'required|max:8|min:8',
            'complemento' => 'max:150',
            'password' => 'required',

        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo name é obrigatorio',
            'name.max' => 'o campo name deve conter no maximo 120 caracteres',
            'celular.required' => 'Celular obrigatoria',
            'celular.max' => 'Celular deve conter no maximo 11 caracteres',
            'celular.min' => 'Celular deve conter no minimo 10 caracteres',
            'email.max' => 'Email deve conter no maximo 120 caracteres',
            'email.required' => 'Email obrigatorio',
            'email.unique' => 'Email ja cadastrado no sistema',
            'email.email' => 'Formato invalido',
            'cpf.required' => 'Cpf obrigatorio',
            'cpf.max' => 'o campo CPF deve conter no maximo 11 caracteres',
            'cpf.min' => 'o campo CPF dever conter no minimo 11 caracteres',
            'cpf.unique' => 'CPF ja cadastrado no sistema',
            'dataNascimento.required' => 'Data de nascimento obrigatorio',
            'dataNascimento.date' => 'formato invalido',
            'cidade.required' => 'Cidade obrigatoria',
            'cidade.max' => 'Cidade deve conter no maximo 120 caracteres',
            'estado.required' => 'Estado obrigatoria',
            'estado.max' => 'Estado deve conter no maximo 2 caracteres',
            'estado.min' => 'Estado deve conter no minimo 2 caracteres',
            'pais.required' => 'Pais obrigatorio',
            'pais.max' => 'Pais deve conter no maximo 80 caracteres',
            'rua.required' => 'Rua obrigatorio',
            'rua.max' => 'Rua deve conter no maximo 120 caracteres',
            'numero.required' => 'Numero obrigatorio',
            'numero.max' => 'Numero deve conter no maximo 10 caracteres',
            'bairro.required' => 'Bairro obrigatorio',
            'bairro.max' => 'Bairro deve conter no maximo 100 caracteres',
            'cep.required' => 'Cep obrigatorio',
            'cep.max' => 'Cep deve conter no maximo 8 caracteres',
            'cep.min' => 'Cep deve conter no minimo 8 caracteres',
            'Complemento.max' => 'Complemento deve conter no maximo 150 caracteres',
            'password.required' => 'password obrigatorio',



        ];
    }
}
