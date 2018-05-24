@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")

<div id="map"></div>


@stop

@section("top_include")
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
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
@stop


@section("bottom_include")
<script src="https://maps.googleapis.com/maps/api/js?key={{ env("MAP_API_KEY","nothing") }}&libraries=places"></script>
<script src="{{ asset("js/markerclusterer.js")}}"></script>
@stop

@section("jquery")

      var map;
      var markers = [];
      var ids = [];
      var prev;

      function showLoca(posi){
        var lat = posi.coords.latitude;
        var long = posi.coords.longitude;
        var myLatlng = new google.maps.LatLng(lat,long);
        map.setCenter(myLatlng)

      }

      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: {{ $lati or  "-6.914744" }}, lng: {{$longi or  "107.609810" }} },
        disableDefaultUI: true, // a way to quickly hide all controls
        zoom: 20,
        gestureHandling: 'greedy'
      });

      getMapBound();


    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLoca);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
    google.maps.event.addListener(map, 'idle', function() {
        getMapBound();
    });

    google.maps.event.addListener(map, 'bounds_changed', function() {
         getMapBound();
    });



    function getMapBound(){
      var bound = map.getBounds();

      if(bound){
        var location = bound.toJSON();

        if(JSON.stringify(location) != prev){
          prev = JSON.stringify(location);

          $.ajax({
               url: "{{ url("/api/pet/location/") }}",
               headers: { 'csrftoken' : '{{ csrf_token() }}' },
               data: JSON.stringify(location),
               type: 'POST',
               datatype: 'JSON',
               contentType: 'application/json',
               success: function (response,stat,xhr) {
                  resp = JSON.parse(response.data);

                  if(xhr.status == 200){
                    var marker;
                    //push to markers
                    for(i=0;i<resp.length;i++){

                      if(ids.indexOf(resp[i]["id"]) <= -1){
                        marker = new google.maps.Marker({
                          position: new google.maps.LatLng(resp[i]["lati"], resp[i]["longi"]),
                          title: resp[i]["title"]
                        });



                        markers.push(marker);
                        ids.push(resp[i]["id"]);
                      }

                    }
                    var markerCluster = new MarkerClusterer(map, markers,
        {imagePath: '{{ asset("images/m/m")}}'});
                  }

               },

           });
        }

      }

    }

@stop
