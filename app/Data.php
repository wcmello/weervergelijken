<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
	//Belongs To relatie met Locations
   public function location()
	{
	    return $this->belongsTo('App\Location');
	}
}
