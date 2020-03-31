<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function data()
    {
        return $this->hasMany('App\Data');
    }
}
