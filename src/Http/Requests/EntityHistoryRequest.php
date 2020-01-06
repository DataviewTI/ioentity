<?php

namespace Dataview\IOEntity;

use Dataview\IntranetOne\IORequest;
use Illuminate\Validation\Rule;

class EntityHistoryRequest extends IORequest
{
  public function sanitize(){
    $input = parent::sanitize();

    if (isset($input['dt_compra_submit']))
      $input['date'] = $input['dt_compra_submit'];

    // if (isset($input['vl_compra_clean']))
      $input['value'] = filled($input['vl_compra_clean']) ? $input['vl_compra_clean'] : 0;

    // if (isset($input['vl_entrada_clean']))
      $input['payment'] = filled($input['vl_entrada_clean']) ? $input['vl_entrada_clean'] : 0;

    $this->replace($input);
    return $input;
  }

    public function rules()
    {
      $input = $this->sanitize();
      if ($this->is('*/update/*')) {
          return [];
      } else {
          return [];
      }
    }

    public function messages(){
      return [
      ];
    }
}
