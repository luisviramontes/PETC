<?php

namespace petc\Http\Requests;

use petc\Http\Requests\Request;

class TablaDePagosRequest extends Request
{
  protected $redirect = "tabulador_pagos/create";
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
      'ciclo' => 'unique:tabulador_pagos,ciclo',
            //
      ];
  }

  public function messages(){
    return [

    'ciclo.unique' => 'Ya se han Registrado los Pagos Correspondientes a este Ciclo Escolar',
    ];
}

public function response(array $errors){
    if ($this->ajax()){
        return response()->json($errors, 200);
    }
    else
    {
        return redirect($this->redirect)
        ->withErrors($errors, 'formulario')
        ->withInput();
    }
}
}
