<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as BaseRequest;
use App\Location;
use Illuminate\Support\Facades\Http;

class ViewController extends Controller
{
	//functie die opgeroepen word als iemand locaties invoerd en op vergelijken drukt
    public function load(Request $request){
    	//valideerd de request met de locaties via een private function in deze controller
    	$result = $this->validator($request);

    	//Controleerd het resultaat van de validatie
    	if (is_string($result)) {
    		//stuurt errors terug die de validatie meegestuurd heeft
    		return back()->withErrors([$result])->withInput();
    		
    	}

    	//als er geen errors zijn word dit uitgevoerd
    	else
    	{
    		//maakt een data array aan
    		$data = [];

    		//Zoekt de data op vanuit de request functie, heeft 2 plaatsnamen nodig
    		$data['data'] = $this->request($request->plaats1, $request->plaats2);

    		//color array die kleuren aangeeft voor de grafiek
    		$colors = [
    			$request->plaats1 => 'rgba(252,7,11,',
    			$request->plaats2 => 'rgba(7,134,252,'
    		];
            $plaatsen = [
                '1' => $request->plaats1,
                '2' => $request->plaats2
            ];
    		//Pushed te color array in het data array om een compleet pakketje te maken
    		array_push($data, $colors);
            array_push($data, $plaatsen);

    		//Stuurt door naar de main view met de opgevraagde data
    		return view('main', compact('data'));
    	}
    }
    private function request($loc1, $loc2){

              $url = BaseRequest::getHttpHost();
              str_replace('https://', '', $url);
    		  $curl = curl_init();
    		  curl_setopt_array($curl, array(
    			//curl URL haalt URL en KEY uit .env file
    			  CURLOPT_URL => $url."/locations?location=" . $loc1 . "," . $loc2,
    			  CURLOPT_RETURNTRANSFER => true,
    			  CURLOPT_ENCODING => "",
    			  CURLOPT_MAXREDIRS => 10,
    			  CURLOPT_TIMEOUT => 5,
    			  CURLOPT_FOLLOWLOCATION => true,
    			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    			  CURLOPT_CUSTOMREQUEST => "GET",
    		  ));
    		//response zetten naar resultaat CURL
            
    		$response = curl_exec($curl);

    		curl_close($curl);
    		//response omzetten naar ARRAY
    		$response = json_decode($response, true);

   			return $response; 

    }
    private function validator($request){
    	//set de 2 plaatsnamen
    	$p1 = $request->plaats1;
    	$p2 = $request->plaats2;

    	//check of de plaatsnamen beide zijn ingevoerd
    	if ($p1 == "" || $p2 == "") {
    		return $error = 'Voer alle 2 plaatsen in';
    	}
    	//check of beide locaties bestaan
    	elseif(!Location::where('name', $p1)->first() && !Location::where('name', $p2)->first()){
    		return $error = 'Geen data van plaats: ' . $p1 . " & " . $p2;
    	}
    	//checked individueel locatie nr 1
    	elseif(!Location::where('name', $p1)->first()){
    		return $error = 'Geen data van plaats: ' . $p1;
    	}
    	//checked individueel locatie nr 2
    	elseif(!Location::where('name', $p2)->first() ){
    		return $error = 'Geen data van plaats: '.  $p2;
    	}
    	
        return true;
    }
}
