<?php

namespace petc;

use Illuminate\Database\Eloquent\Model;

class SolicitudesModel extends Model
{

    protected $table= "solicitudes";
      //
      public function ScopeLatest($query){
  			return $query->orderBy("id","desc");
  		}

  		public function ScopeSearch($query){
  			return $query->orderBy("id","desc");
  		}
}
