<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use DateTime;
class Comment extends Model
{
	protected $table='comments';
	
	public function commentTime(){
	    $now = new DateTime(date('Y-m-d H:i:s'));
        $adate = new DateTime($this->created_at);
        $interval = $adate->diff($now);

        $xxxx = '';
        if($interval->y > 0){
          $xxxx = $interval->y.' Years Ago';
        }
        else if($interval->m > 0){
          $xxxx = $interval->m.' Mon Ago';
        }
        else if($interval->d > 0){
          $xxxx = $interval->d.' Day Ago';
        }
        else if($interval->h > 0){
          $xxxx = $interval->h.' Hour, ';
          $xxxx .= $interval->i.' Min Ago';
        }
        else {
          $xxxx = $interval->i.' Min Ago';
        }
        return $xxxx;
	}
}
