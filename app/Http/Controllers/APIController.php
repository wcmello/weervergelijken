<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Data;
class APIController extends Controller
{
    public function show(Request $request){
    	//haal locaties op uit de get request en haalt ze uit elkaar
    	$locations = explode (",", $request->input('location'));  

    	//empty array voor historische data
    	$historyarray = [];

    	//empty array voor complete data (historische/recent)
    	$recentarray = [];

    	//empty array voor combinatie beide
    	$completearray = [];
    	//loop door de locaties en haal de data op van elke locatie
    	foreach ($locations as $location) {
	    	$historisch = Location::where('name', $location)->first();

	    	//vullen van historische data met een limiet op 10 recente data
	    	$historyarray['History'][$location] = $historisch->data()->latest()->limit(10)->get(); 

	    	//vullen van recente data
	    	$recentarray['Recent'][$location] = $historisch->data()->latest()->first();

	    }
	    //combineer array voor de request return
	    array_push($completearray, $historyarray , $recentarray);
    	return $completearray;

    }
    //deze functie zou om de 4 uur moeten runnen om de data op te halen 
    public function getData(){
    	//haal alle bestaande locaties op uit de database
    	$locations = Location::get();
    	
    	//loop door de locaties heen
    	foreach ($locations as $location) {
    		//nieuwe curl request
    		  $curl = curl_init();
			  curl_setopt_array($curl, array(
			//curl URL haalt URL en KEY uit .env file
			  CURLOPT_URL => env('API_URL')."?key=".env('API_KEY')."&locatie=".$location->name."",
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

			//nieuwe data instance aanmaken om te storen in de database
			$data = new Data;
			$data->temp = $response['liveweer']['0']['temp'];
			$data->rainChance = $response['liveweer']['0']['d0neerslag'];
			$data->location_id = $location->id;
			$data->save();

    	}

    	
    }
}
