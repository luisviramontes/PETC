<?php

namespace petc;

use Illuminate\Database\Eloquent\Model;

class ListasAsistenciaModel extends Model
{
	protected $table= "listas_de_asistencias";

	public function ScopeLatest($query){
		return $query->orderBy("id","desc");
	}

}
