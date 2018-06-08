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


  //get all type of Pet
  Route::get("pet/{parent}","Dashboard@childTypePet");

  //list of pet in current bound
  Route::post("pet/location","Dashboard@getAllLocation");

  //get list of post
  Route::get("post/list/{id}/{page}/{slug}","Profile@getPostProfile");
