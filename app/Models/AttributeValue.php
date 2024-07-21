<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;


class AttributeValue extends Model
{
    //
	protected $table = 'attribute_values';
    
    public function attribute(){
        return $this->belongsTo('App\Models\Attribute');
    }
}



