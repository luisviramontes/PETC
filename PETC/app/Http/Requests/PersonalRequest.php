<?php

namespace petc\Http\Requests;

use petc\Http\Requests\Request;

class PersonalRequest extends Request
{
      protected $redirect = "personal/create";
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
      'rfc_input' => 'unique:personal,rfc',
            //
      ];
  }

  public function messages(){
    return [

    'rfc_input.unique' => 'Ya se ha Registrado Este RFC, Verifique los Datos',
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

