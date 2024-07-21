<?php

namespace App\Models;
use App\Models\Service;
use App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function subCategories(){
        return Category::where('parent_id',$this->id)->get();
    }

    public function services(){
        return Service::where('category_id',$this->id)->where('status',1)-get();
    }
    
    public function projects(){
        return Project::where('category_id',$this->id)->where('status',1)-get();
    }
    
    
}
