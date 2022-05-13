<?php

use Illuminate\Http\Request;

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

/**
 * Social Netwrok API
 * **/

Route::post('ask-request', 'Api\SocialMediaController@store_request');
Route::post('manage-request', 'Api\SocialMediaController@manage_request');
Route::post('list-request', 'Api\SocialMediaController@list_request');

Route::post('list-friends', 'Api\SocialMediaController@list_friends');
Route::post('retrieve-friends', 'Api\SocialMediaController@retrieve_friends');

Route::post('block-user', 'Api\SocialMediaController@block_user');


