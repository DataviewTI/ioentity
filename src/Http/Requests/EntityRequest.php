<?php

namespace Dataview\IOEntity;

use Dataview\IntranetOne\IORequest;
use Illuminate\Validation\Rule;

class EntityRequest extends IORequest
{
  public function sanitize()
  {
    $input = parent::sanitize();
    $input['cidade_id'] = $input['cidade_id'];
    $input['cpf_cnpj'] = preg_replace('/\D/', '', $input['cpf_cnpj']);
    $input['cep'] = preg_replace('/\D/', '', $input['cep']);

    if (is_array($input['tipo'])) {
        $input['tipo'] = implode(',', $input['tipo']);
    }

    if (isset($input['dt_nascimento_submit']))
      $input['dt_nascimento'] = $input['dt_nascimento_submit'];

    $this->replace($input);
    return $input;
  }

    public function rules()
    {
      $input = $this->sanitize();
      if ($this->is('*/update/*')) {
          return [
              'cpf_cnpj' => 'required|max:14|unique:entidades,id,'.$input['__form_edit'],                
              'nome_fantasia' => 'required',
              'celular1' => 'required',
              'email' => 'required|email',
              'cep' => 'required',
          ];
      } else {
          return [
              'cpf_cnpj' => 'required|max:14|unique:entidades',
              'nome_fantasia' => 'required',
              'celular1' => 'required',
              'email' => 'required|email',
              'cep' => 'required',
          ];
      }
    }

    public function messages(){
      return [
          'cpf_cnpj.unique' => 'CPF/CNPJ já existe',
          'email_domain' => 'O email deve ser do domínio',
      ];
    }
}
