<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/countries/list', [CountryController::class, 'list']);

Route::get('/countries/visited', [CountryController::class, 'visitedCountries']);

Route::post('/add-visited-country', [CountryController::class, 'addVisitedCountry']);

Route::delete('/remove-visited-country/{countryID}', [CountryController::class, 'removeVisitedCountry']);
