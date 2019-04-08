<?php

namespace petc\Http\Requests;

use petc\Http\Requests\Request;

class RegionRequest extends Request
{
    protected $redirect = "region/create";
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

              'region' => 'unique:region,region',

        ];
    }

    public function messages(){
      return[
        'region.unique' => 'Ya se ha registrado esta Region, verifique sus datos',
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
