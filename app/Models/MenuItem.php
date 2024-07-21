<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    //
    protected $table = 'menu_items';

    public function parent()
    {
        return $this->belongsTo('App\Models\MenuItem','parent_id','id');
    }
    public function Menu()
    {
        return $this->belongsTo('App\Models\Menu','menu_id','id');
    }
    
    public function subMenu(){
        return MenuItem::where('parent_id',$this->id)->where('status',1)->orderBy('order','asc')->get();
    }
}
