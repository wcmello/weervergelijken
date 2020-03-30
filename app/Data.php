<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
   protected $table = 'weerdata';
   public function location()
	{
	    return $this->belongsTo(Location::class);
	}
}
