<?php

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

Route::get("/","HomePage@index");

//WHEN USER DONT HAVE CREDENTIAL
Route::group(['middleware' => 'notHaveLogin'], function () {
  //REGISTRATION ROUTES

  Route::get('register', function () {
      return view('register');
  });
  Route::post('register','Dashboard@register');
  Route::get('register/confirm/{hash}','Dashboard@registConfirm');
  Route::get('register/success', function () {
      return view('registerMsg.registerSuccess');
  });
  Route::get('register/success/activate', function () {
      return view('registerMsg.activateSuccess');
  });

  //LOGIN ROUTE
  Route::get('login', function () {
      return view('login');
  });
  Route::post('login','Dashboard@login');

});






//WHEN USER HAS LOGIN
Route::group(['middleware' => 'hasLogin'], function () {
  Route::get("/dashboard","Dashboard@index");
  //Owner of pet block
  Route::get('open',"Owner@list");
  Route::get('open_adopt',"Owner@newView");
  Route::post('open_adopt',"Owner@new");
  Route::get('open_adopt/delete/{id}',"Owner@singleDelete");
  Route::get('open_adopt/edit/{id}',"Owner@editView");
  Route::post('open_adopt/edit/{id}',"Owner@edit");



  //get all type of Pet
  Route::get("api/pet/{parent}","Dashboard@childTypePet");


  //profile
  Route::get("profile","Profile@editProfile");
  Route::post("profile","Profile@editProfileSave");


  Route::get('logout','Dashboard@logout');

});
