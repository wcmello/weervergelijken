<?php

use Illuminate\Database\Seeder;
use App\Location;
use App\Data;

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

            $data = new Data;

            $data->location_id = $location->id;
            $data->temp = 0;
            $data->rainChance = 0;
            $data->dateTime = now();
            $data->save();
    	}

    }
}
