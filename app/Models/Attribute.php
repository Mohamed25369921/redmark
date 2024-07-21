<?php

namespace App\Models;

use App\ModelsProductAttribute;
use App\ModelsAttributeValue;
use Illuminate\Database\Eloquent\Model;
use DB;


class Attribute extends Model
{
    //
	protected $table = 'attributes';

    public function values(){
        return AttributeValue::where('attribute_id',$this->id)->get();
    }


    public function projectAttributeValues($id){
        $projectAttrIds = ProjectAttribute::where('project_id',$id)->where('attribute_id',$this->id)->pluck('attribute_value_id')->toArray();
        return AttributeValue::whereIn('id',$projectAttrIds)->get();
    }

    
}



