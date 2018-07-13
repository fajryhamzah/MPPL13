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

Route::get("/",function(){
  return view("homepage");
});

//see avalaible
Route::get("post/{id}","Seeker@detail");

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
  Route::post('open',"Owner@massDelete");
  Route::get('open_adopt',"Owner@newView");
  Route::post('open_adopt',"Owner@new");
  Route::get('open_adopt/delete/{id}',"Owner@singleDelete");
  Route::get('open_adopt/edit/{id}',"Owner@editView");
  Route::post('open_adopt/edit/{id}',"Owner@edit");



  //profile
  Route::get("profile","Profile@showProfile");
  Route::get("profile/{uname}","Profile@showProfile");
  Route::get("setting/profile","Profile@editProfile");
  Route::post("setting/profile","Profile@editProfileSave");
  Route::get("setting/change_password",function(){
    $data["page"] = "change";
    return view("profile.change_password",$data);
  });
  Route::post("setting/change_password","Profile@changePassword");
  Route::get("setting/notification","Profile@notification");
  Route::post("setting/notification","Profile@notificationHandler");

  //finder
  Route::get("finder","Seeker@index");
  Route::get("advance_finder","Seeker@finder");
  Route::post("advance_finder","Seeker@finderAction");


  //POST
  Route::post("post/{id}","Seeker@apply");
  Route::get('logout','Dashboard@logout');
  Route::get("post/{id}/approve/{adopt}","Owner@approve");


  //fix it later
  Route::get("api/notification","Dashboard@notif");

});
