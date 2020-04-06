<?php

use Illuminate\Database\Seeder;
use App\Location;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $loc = ['Gorredijk', 'Heerenveen'];
    	foreach ($loc as $l) {
    		$location = new Location;
    		$location->name = $l;
    		$location->save();
    	}
    }
}
