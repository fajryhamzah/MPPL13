@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")

<div class="row" style="height:100%">
  <div class="col s12" style="height:100%;padding:0px">
    <div class="col s12" style="height:100%;padding:0px" id="map_parent">
        <div id="map"></div>
    </div>
    <div class="col s3" id="result_parent">
      <div id="result"></div>
    </div>
  </div>
</div>


@stop

@section("css")
<link rel="stylesheet" href="{{asset("css/animate.css")}}">
@stop

@section("top_include")
<style>
      #result_parent{
        display: none;
      }
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
        margin-top: 5px;
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
        gestureHandling: 'greedy',
        clickableIcons: false,
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

    function addCard(info){

    }



    function getMapBound(){
      var bound = map.getBounds();

      if(bound){
        var location = bound.toJSON();
        location.id= {{$id}};

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
                  var resp = JSON.parse(response.data);

                  if(xhr.status == 200){
                    var marker;
                    //push to markers
                    for(i=0;i<resp.length;i++){

                      if(ids.indexOf(resp[i]["id"]) <= -1){
                        marker = new google.maps.Marker({
                          position: new google.maps.LatLng(resp[i]["lati"], resp[i]["longi"]),
                          title: resp[i]["title"],
                          url: "{{ url('post/') }}/"+resp[i]['id'],
                          id: resp[i]["id"]
                        });

                        marker.addListener('click',function(){
                          window.open(this.url,"_blank");
                        });

                        markers.push(marker);
                        ids.push(resp[i]["id"]);
                      }

                    }
                    var markerCluster = new MarkerClusterer(map, markers,
                        {
                          imagePath: '{{ asset("images/m/m")}}',
                          zoomOnClick: false,
                      });

                        google.maps.event.addListener(markerCluster, "clusterclick", function (e) {
                            listIDS = e.getMarkers().map(function(a){
                              return a.id;
                            });
                            var jsn = JSON.stringify(listIDS);
                            $("#map_parent").removeClass("s12").addClass("s9");
                            $("#result_parent").show();
                            $("#result_parent").addClass("fadeInRight");
                            $("#result").html("wait...");

                            $.ajax({
                              type: "POST",
                              url: "{{ url('api/post/detail') }}",
                              data: {data: jsn},
                              cache: false,
                              success:function(response){
                                if(response){
                                  resp = JSON.parse(response);

                                  resp.forEach(function(e){
                                    $("#result").append("<span><a href='{{ url('post/') }}/"+e.id+"' target='_BLANK'>"+e.title+"</a></span>");

                                  });
                                }
                              }
                            });

                        });
                  }

               },

           });
        }

      }

    }

@stop
