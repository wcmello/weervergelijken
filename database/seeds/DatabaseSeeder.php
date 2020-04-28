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
        //nieuwe curl request
          $curl = curl_init();
          curl_setopt_array($curl, array(
        //curl URL haalt URL en KEY uit .env file
          CURLOPT_URL => "https://opendata.cbs.nl/ODataApi/OData/84489NED/Woonplaatsen",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));
        //response zetten naar resultaat CURL
        $response = curl_exec($curl);

        curl_close($curl);
        //response omzetten naar ARRAY
        $response = json_decode($response, true);
        //loop trough city array
        foreach ($response['value'] as $value) {
            $loc = Location::create(['name' => $value['Title']]);
            Data::create(['location_id' => $loc->id, 'temp' => 0, 'rainChance' => 0, 'dateTime' => now()]);
        }

    }
}
