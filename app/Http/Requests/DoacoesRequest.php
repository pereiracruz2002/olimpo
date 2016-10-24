<?php

namespace PET\Http\Requests;

use PET\Http\Requests\Request;

class DoacoesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'titulo' => 'required',
           'descricao' => 'required',
           'tipo' => 'required',
           'categoria' => 'required',
           'status' => 'required'
        ];
    }


    public function messages()
    {
        

        return [
            'titulo.required' => 'Titulo é obrigatório',
            'descricao.required'  => 'Descrição é obrigatório',
            'tipo.required' => 'Tipo é obrigatório',
            'categoria.required'=>'Categoria é obrigatório',
            'status.required' => 'Status é obrigatório'
        ];
    }
}
