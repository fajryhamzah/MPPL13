@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")
  <section>
    <div style="margin-top:2%;">
      <div class="row">
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4>@lang("profile/edit_profile.crop")</h4>
            <div id="image-modal"></div>
            <a href="#!" id="cropit" class="modal-close waves-effect waves-green btn" style="margin:0 auto;width:10%;display:block">@lang("profile/edit_profile.crop_button")</a>
          </div>
        </div>
        <div class="col s12" >
            @include("profile.side")
            <div class="col s7 content">
              <div class="col s12 offset-s2">
                {{ \Session::get("error") }}
                <form name="editProf" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col s4 offset-s2" style="text-align:center">
                        <img src="{{ ($img)? asset("img/avatar/".$img) : asset("images/default.png") }}" class="circle responsive-img" id="img-check">
                        <div class="file-field input-field">
                           <div>
                             <span>@lang("profile/edit_profile.change_image_button")</span>
                             <input type="file" id="upload" name="profic">
                           </div>
                           <div class="file-path-wrapper" style="display:none">
                            <input class="file-path validate" type="text">
                          </div>
                         </div>
                      </div>
                    </div>

                    <div class ="row">
                      <div class="input-field col s8">
                        <input id="first_name2" type="text" class="validate" name="username" value="{{ old("username",$username) }}">
                        <label class="active" for="first_name2">Username</label>
                      </div>
                    </div>

                    <div class ="row">
                      <div class="input-field col s8">
                        <input id="name" type="text" class="validate" name="name" value="{{ old("name",$name) }}">
                        <label class="active" for="name">@lang("profile/edit_profile.name")</label>
                      </div>
                    </div>

                    <div class ="row">
                      <div class="input-field col s8">
                        <input id="email" type="email" class="validate" name="email" value="{{ old("email",$email) }}">
                        <label class="active" for="email">E-mail</label>
                      </div>
                    </div>

                    <div class ="row">
                      <div class="input-field col s8">
                        <textarea id="bio" name="bio" class="materialize-textarea" data-length="60">{{ old("bio",$bio) }}</textarea>
                        <label class="active" for="bio">Bio</label>
                      </div>
                    </div>

                    <div class="row" style="width:70%; height:100%;">
                      <div class="input-field col s12">
                        <h6>@lang("profile/edit_profile.location") :</h6>
                        <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                        <div id="map"></div>
                      </div>
                    </div>

                    <input type="hidden" name="lat" id="lat" />
                     {{ csrf_field() }}
                    <input type="hidden" name="lng" id="lng"/>
                    <input type="hidden" name="img_hidden" id="img_hidden"/>

                    <div class="row">
                      <div class="input-field col s6">
                        <button type="submit" class="btn btn-primary">@lang("profile/edit_profile.submit")</button>
                      </div>
                    </div>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop

@section("top_include")
<link rel="stylesheet" href="{{asset("css/croppie.min.css")}}">
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 350px;
        margin-top:20px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }

      .croppie-container .cr-image{
        position: relative;
      }

      .modal{
        width:80%;
        max-height: 85%;
      }
</style>
<script src="{{asset("js/croppie.min.js")}}"></script>
@stop

@section("jquery")
    $('#bio').characterCounter();
    var $uploadCrop;
    function readFile(input) {
 			if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              $('#image-modal').addClass('ready');
              $uploadCrop.croppie('bind', {
                url: e.target.result
              }).then(function(){
                console.log('bind complete');
              });
            };

            reader.readAsDataURL(input.files[0]);
            $('.modal').modal();
            $("#modal1").modal("open");

	        }
	        else {
		        alert("Sorry - you're browser doesn't support the FileReader API");
		    }
		}

    $('#upload').on('change', function () { readFile(this); });
    $uploadCrop = $('#image-modal').croppie({
			viewport: {
				width: 250,
				height: 250,
				type: 'circle'
			},
			enableExif: true
		});
    $('#cropit').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'base64',
				size: 'viewport'
			}).then(function (resp) {
        $("#img_hidden").val(resp);
        $("#img-check").attr("src",resp);
			});
		});

@stop

@section("bottom_include")
<script src="https://maps.googleapis.com/maps/api/js?key={{ env("MAP_API_KEY","nothing") }}&libraries=places"></script>
</script>
<script>
      var map;
      var lat;
      var long;
      var marker = null;
      function showLoca(posi){
        lat = posi.coords.latitude;
        long = posi.coords.longitude;
        var myLatlng = new google.maps.LatLng(lat,long);
        setLatLng();
        map.setCenter(myLatlng)
        placeMarker(myLatlng);

      }
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: {{ ($lati) ? $lati :  "-6.914744" }}, lng: {{ ($longi) ? $longi :  "107.609810" }} },
        disableDefaultUI: true, // a way to quickly hide all controls
        zoom: 17,
        gestureHandling: 'greedy'
      });

      @if($lati)
        lat = {{ ($lati) ? $lati :  "-6.914744" }};
        long = {{ ($longi) ? $longi :  "107.609810" }};
        var myLatlng = new google.maps.LatLng(lat,long);
        setLatLng();
        map.setCenter(myLatlng)
        placeMarker(myLatlng);
      @endif


        // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });

    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }

      marker.setMap(null);
      // For each place, get the icon, name and location.
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }
        // Create a marker for each place.
        placeMarker(place.geometry.location);

        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.fitBounds(bounds);
    });


    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLoca);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }


    google.maps.event.addListener(map, 'click', function(event) {
      lat = event.latLng.lat();
      long = event.latLng.lng();
      setLatLng();
      placeMarker(event.latLng);
    });

    function placeMarker(location) {
    if(marker) marker.setMap(null);

    lat = location.lat();
    long = location.lng();
    marker = new google.maps.Marker({
        position: location,
        draggable: true,
        animation: google.maps.Animation.DROP,
        map: map
    });
    setLatLng();
    }

function setLatLng(){
document.getElementById("lat").value = lat;
document.getElementById("lng").value = long;
}
</script>

@stop
