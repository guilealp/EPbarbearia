<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServicoFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:80|min:5|unique:servicos,name',
            'descricao' => 'required|max:200|min:10',
            'duracao' => 'required|numeric',
            'preco' => 'required|decimal:2',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'sucess' => false,
            'error' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo name é obrigatorio',
            'name.max' => 'o campo name deve conter no maximo 80 caracteres',
            'name.min' => 'o campo name dever conter no minimo 5 caracteres',
            'name.unique' => 'name ja cadastrado no sistema',
            'descricao.required' => 'Descrição obrigatoria',
            'descricao.max' => 'Descrição deve conter no maximo 200 caracteres',
            'descricao.min' => 'Descrição deve conter no minimo 10 caracteres',
            'duracao.required' => 'Duração obrigatoria',
            'duracao.numeric' => 'Formato invalido, aceita somente numeros',
            'preco.decimal' => 'formato invalido',
            'preco.required' => 'Preço obrigatorio',

        ];
    }
}
