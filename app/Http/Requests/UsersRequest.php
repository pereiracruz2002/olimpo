<?php

namespace PET\Http\Requests;

use PET\Http\Requests\Request;

class UsersRequest extends Request
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
                  'nome' => 'required',
                  'email'=> 'required|email|unique:users,email',
                  'senha'=> 'required',
                  'cpf'=>'required'
              ];
   }

   public function messages()
   {
       return [
           'nome.required' => 'Nome é obrigatório',
           'email.required'  => 'Email é obrigatório',
           'email.email'  => 'Email inválido',
           'senha.required' => 'Senha é obrigatório',
           'email.unique'=>'Email já existente',
           'cpf.required'=>'CPF é obrigatório'
       ];

   }
}
