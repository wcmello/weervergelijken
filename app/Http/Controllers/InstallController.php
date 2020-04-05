<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Illuminate\Support\Facades\Schema;
use Artisan;

class InstallController extends Controller
{
    public function dbinstall(){
	    if (!Schema::hasTable('locations')) {
	    	Artisan::call('migrate', ["--force"=> true ]);
	    	$this->locinstall();
	    	echo "Installed Database Successfully";
		}
		else{
			echo "Database Installation failed or unneccesary";
		}
    }
    public function locinstall(){
    	$loc = ['Gorredijk', 'Heerenveen'];
    	foreach ($loc as $l) {
    		$location = new Location;
    		$location->name = $l;
    		$location->save();
    	}
    }		
}
