<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerApplication extends Model
{
    protected $table = 'careers_applications';
    
    public function career(){
        return $this->belongsTo('App\Models\Career','career_id','id');
    }
}
