<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\ModelsProjectImage;
use App\ModelsProjectAttribute;
class Project extends Model
{
	protected $table='projects';
	
	public function images(){
	    return ProjectImage::where('project_id',$this->id)->get(); 
	}

	public function category(){
	    return $this->belongsTo('App\Models\Category');
	}
	
	public function region(){
	    return $this->belongsTo('App\Models\Region');
	}
	
    public function attributes(){
        $projecttAttributeIds = ProjectAttribute::where('project_id',$this->id)->distinct()->pluck('attribute_id')->toArray();
        $attributes = Attribute::whereIn('id',$projecttAttributeIds)->get();
        return $attributes;
    }

}
