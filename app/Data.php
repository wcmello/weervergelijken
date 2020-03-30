<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
   public function location()
	{
	    return $this->belongsTo(Location::class);
	}
}
