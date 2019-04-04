<?php

namespace petc;

use Illuminate\Database\Eloquent\Model;

class CatPuestoModel extends Model
{
	protected $table= "cat_puesto";
    //

		public function ScopeLatest($query){
			return $query->orderBy("id","desc");
		}

		public function ScopeSearch($query){
			return $query->orderBy("id","desc");
		}
}
