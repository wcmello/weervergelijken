<?php

use Illuminate\Support\Facades\Route;
use App\Location;
use App\Http\Resources\Location as LocationResource;
use App\Data;
use App\Http\Resources\Data as DataResource;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	if (file_exists('../storage/installed')) {
	    return view('main');
    }
    else {
    	return redirect('install');
    }
});
//main route

//main route on post
Route::post('/', 'ViewController@load');

//main api route requires ?location= parameter with cities split by commas
Route::get('/locations', 'APIController@show');
/*
Route::get('/install', 'InstallController@dbinstall');
*/