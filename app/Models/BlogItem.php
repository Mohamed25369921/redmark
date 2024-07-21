<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BlogImage;

class BlogItem extends Model
{
    //
    protected $table = 'blogitems';
    public function Blogcat()
    {
        return $this->belongsTo('App\Models\BlogCategory','blogcategory_id','id');
    }
    
    public function writer(){
	    return $this->belongsTo('App\Models\Writer','writer_id');
	}
	
	    public function images(){
	    return BlogImage::where('blogItem_id',$this->id)->get(); 
	}
}
