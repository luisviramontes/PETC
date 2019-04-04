<?php

namespace petc\Http\Requests;

use petc\Http\Requests\Request;

class CentroTrabajoRequest extends Request
{
      protected $redirect = "centro_trabajo/create";
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
      'cct' => 'unique:centro_trabajo,cct',
            //
      ];
  }

  public function messages(){
    return [

    'cct.unique' => 'Ya se ha Registrado Esta CCT, Verifique los Datos',
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

