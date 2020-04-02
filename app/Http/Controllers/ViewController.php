<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class ViewController extends Controller
{
    public function load(Request $request){
    	$result = $this->val($request);
    	if (is_string($result)) {
    		return back()->withErrors([$result]);
    		
    	}
    	else
    	{
    		$data = [];
    		$data['data'] = $this->request($request->plaats1, $request->plaats2);

    		$colors = [
    			$request->plaats1 => 'rgba(252,7,11,',
    			$request->plaats2 => 'rgba(7,134,252,'
    		];
    		array_push($data, $colors);
    		return view('main', compact('data'));
    	}
    }
    private function request($loc1, $loc2){

    		//nieuwe curl request
    		  $curl = curl_init();
			  curl_setopt_array($curl, array(
			//curl URL haalt URL en KEY uit .env file
			  CURLOPT_URL => "http://weer.test/locations?location=" . $loc1 . "," . $loc2,
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
   			
   			return $response; 	

    }
    private function val($request){
    	$p1 = $request->plaats1;
    	$p2 = $request->plaats2;
    	if ($p1 == "" || $p2 == "") {
    		return $error = 'Voer alle 2 plaatsen in';
    	}
    	elseif(!Location::where('name', $p1)->first() && !Location::where('name', $p2)->first()){
    		return $error = 'Geen data van plaats: ' . $p1 . " & " . $p2;
    	}
    	elseif(!Location::where('name', $p1)->first()){
    		return $error = 'Geen data van plaats: ' . $p1;
    	}
    	elseif(!Location::where('name', $p2)->first() ){
    		return $error = 'Geen data van plaats: '.  $p2;
    	}
    	else{
    		return true;
    	}
    }
}
