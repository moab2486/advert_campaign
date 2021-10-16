<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::match(['post', 'put'], 'submit_advert_campaign', 'advertisingCampaignController@submitCampaign');
Route::get('retrive_campaigns', 'advertisingCampaignController@retriveCampaigns');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
