<?php

namespace PET\Http\Requests;

use PET\Http\Requests\Request;

class UserServicesRequest extends Request
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
//        return [
//           'cnpj' => 'required',
//           'descricao' => 'required',
//           'endereco' => 'required',
//           'bairro' => 'required',
//           'cidade' => 'required',
//           'estado' => 'required',
//           'cep' => 'required',
//           'servicos_id' => 'required',
//           'users_id' => 'required',
//           'telefone' => 'required'
//        ];

        return [

            'descricao' => 'required',
            'servicos_id' => 'required',
            'empresas_id' => 'required',
        ];

    }

    public function messages()
    {
        

//        return [
//            'cnpj.required' => 'CNPJ é obrigatório',
//            'descricao.required'  => 'Descrição é obrigatório',
//            'endereco.required' => 'Endereço é obrigatório',
//            'bairro.required'=>'Bairro é obrigatório',
//            'cidade.required' => "Cidade é obrigatório",
//            'estado.required' => "Estado é obrigatório",
//            'cep.required'=> "CEP é obrigatório",
//            'servicos_id.required' => "Serviço id é obrigatória",
//            'users_id.required' => "User id é orbigatória",
//            'telefone.required' => "Telefone é obrigatório"
//        ];

        return [

            'descricao.required'  => 'Descrição é obrigatório',
            'servicos_id.required' => "Serviço id é obrigatória",
            'empresas_id.required' => "User id é orbigatória",
        ];
    }
}
