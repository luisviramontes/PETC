<?php

namespace petc;

use Illuminate\Database\Eloquent\Model;

class CentroTrabajoModel extends Model
{
	protected $table= "centro_trabajo";

	public function ScopeCiclo($query,$ciclo_escolar){
		if($ciclo_escolar)
		return $query->Orwhere('ciclo_escolar','LIKE',"%$ciclo_escolar%");
	}

	public function ScopeCategoria($query,$categoria){
		if($categoria)
		return $query->Orwhere('categoria','LIKE',"%$categoria%");
	}

}
