<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class ParseController extends Controller
{
    public function woonplaatsen(){
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
		//set var to show total cities added
		$loccount = 0;
		//loop trough city array
		foreach ($response['value'] as $value) {
			$location = new Location;
			$location->name = $value['Title'];
			$location->save();
			$loccount++;
		}
		//show cities saved 
		echo "Saved " . $loccount . " New Locations";
    }
}
