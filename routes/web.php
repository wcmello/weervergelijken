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
    return view('main');
});
Route::get('/locations', function () {
    /*return LocationResource::collection(Location::all());*/
    $data = App\Location::find(1);
    dd($data->data());
});
Route::get('/data', function () {
    $data = App\Data::first();
    dd($data->location());
});