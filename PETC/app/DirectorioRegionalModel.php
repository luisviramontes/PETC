<?php

namespace petc;

use Illuminate\Database\Eloquent\Model;

class DirectorioRegionalModel extends Model
{
	protected $table= "directorio_regional";
    //

		public function ScopeLatest($query){
			return $query->orderBy("id","desc");
		}

		public function ScopeSearch($query){
			return $query->orderBy("id","desc");
		}

		public function ScopeRegion($query,$region){
      if($region)
      return $query->Orwhere('region','LIKE',"%$region%");
    }

    public function ScopeSostenimiento($query,$sostenimiento){
      if($sostenimiento)
      return $query->Orwhere('sostenimiento','LIKE',"%$sostenimiento%");
    }

		public function ScopeNombreEnlace($query,$nombre_enlace){
      if($nombre_enlace)
      return $query->Orwhere('nombre_enlace','LIKE',"%$nombre_enlace%");
  	}

}
