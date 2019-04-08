<?php

namespace petc;

use Illuminate\Database\Eloquent\Model;

class RegionModel extends Model
{
    	protected $table= "region";

      public function ScopeLatest($query){
        return $query->orderBy("created_at","desc");
      }

}
