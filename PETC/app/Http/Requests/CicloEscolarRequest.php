<?php

namespace petc\Http\Requests;

use petc\Http\Requests\Request;

class CicloEscolarRequest extends Request
{

  protected $redirect = "ciclo_escolar/create";

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
            'ciclo' => 'unique:ciclo_escolar,ciclo',
        ];
    }

    public function messages(){
      return[
        'ciclo.unique' => 'Ya se ha registrado este Ciclo Escolar',
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
