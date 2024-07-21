<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\ModelsProject;

class Brand extends Model
{
	protected $table='brands';
	

    public function projectsCount(){
        return Project::where('brand_id',$this->id)->where('status',1)->count();
    }

}
