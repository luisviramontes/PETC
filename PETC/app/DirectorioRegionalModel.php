<?php

namespace petc;

use Illuminate\Database\Eloquent\Model;

class DirectorioRegionalModel extends Model
{
	protected $table= "directorio_regional";
    //

		public function method(){
					return $this->id ? 'PUT' : 'POST';
					//si existe id usar el metodo PUT , si no el metodo POST
			}

			public function url(){
				return $this->id ? 'directorio_regional.update' : 'directorio_regional.store';
				//si el id existe va a producs.update si no a .Store
			}
}
