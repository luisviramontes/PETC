<?php

namespace petc;

use Illuminate\Database\Eloquent\Model;

class CicloEscolarModel extends Model
{
    protected $table= "ciclo_escolar";

    public function ScopeLatest($query){
			return $query->orderBy("id","desc");
		}

		public function ScopeSearch($query){
			return $query->orderBy("id","desc");
		}
}
