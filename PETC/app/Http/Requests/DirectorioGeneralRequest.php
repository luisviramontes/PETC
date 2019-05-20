<?php

namespace petc\Http\Requests;

use petc\Http\Requests\Request;

class DirectorioGeneralRequest extends Request
{ protected $redirect = "directorio_regional/create";
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
              'telefono' => 'min:10',
        ];
    }
    public function messages(){
      return [

      'telefono.min' => 'El numero telefonico consta de 10 digitos, revisa tus datos.',
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
