<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class ViewController extends Controller
{
    public function load(Request $request){
    	if ($request->plaats1 == "" || $request->plaats2 == "") {
    		return back()->withErrors(['Voer alle 2 plaatsen in']);
    	}
    	elseif(!Location::where('name', $request->plaats1)->first() && !Location::where('name', $request->plaats2)->first()){
    		return back()->withErrors(['Geen data van plaats: ' . $request->plaats1 . " & " . $request->plaats2]);
    	}
    	elseif(!Location::where('name', $request->plaats1)->first()){
    		return back()->withErrors(['Geen data van plaats: ' . $request->plaats1]);
    	}
    	elseif(!Location::where('name', $request->plaats2)->first() ){
    		return back()->withErrors(['Geen data van plaats: '.  $request->plaats2]);
    	}
    	else
    	{
    		$data = [];
    		$data['data'] = $this->request($request->plaats1, $request->plaats2);
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
}
