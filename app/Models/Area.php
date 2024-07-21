<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;


class Area extends Model
{
    //
	protected $table='areas';

    public function region(){
        return $this->belongsTo('App\Models\Region','region_id');
    }
}
