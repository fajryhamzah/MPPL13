@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")
<div class="row" style="height:100%">
  <div class="col s12 advance_search">
    <form name="advance_finder" method="post" action="{{url("advance_finder")}}">
      <div class="col s2">
        <select name="category" id="pet">
          <option value="" disabled selected>Category</option>
          @foreach($category as $a)
            <option value="{{ $a->id }}">{{ $a->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col s2">
        <select name="type" id="ty">
          <option value="" disabled selected>Type</option>
        </select>
      </div>

      <div class="col s2">
        <select name="gender">
          <option value="0">Male</option>
          <option value="1">Female</option>
        </select>
      </div>

      <div class="col s2" style="margin-top:1%">
        <div style="margin-bottom:3%;">
            <span>Age</span>
        </div>
        <div id="age-slider"></div>
      </div>

      <div class="col s2" style="margin-top:1%">
        <div style="margin-bottom:3%;">
            <span>Distance</span>
        </div>
        <div id="distance-slider"></div>
      </div>

      <div class="col s2" style="margin-top:1%">
        <button class="btn waves-effect waves-light" type="submit" name="action">Search</button>
      </div>
      <input type="hidden" name="ageMin" id="amin" value="0" />
      <input type="hidden" name="ageMax" id="amax" value="20" />
      <input type="hidden" name="distMax" id="dmax" value="10" />
      <input type="hidden" name="lat" id="lat" />
      <input type="hidden" name="lng" id="lng" />
    </form>
  </div>
  <div class="col s12" style="height:100%;padding:0px">
    <div class="col s12" style="height:100%;padding:0px;" id="map_parent">
      <input id="pac-input" class="controls" type="text" placeholder="@lang("open_post/open.loca_holder")">

      <a id="gps">
        <i class="medium material-icons">gps_fixed</i>
      </a>

        <div id="map"></div>
    </div>
    <div class="col s3" id="result_parent" style="overflow-y:scroll;height:100%;">
      <div class="col s12" id="result">

      </div>
    </div>
  </div>
</div>


@stop

@section("css")
<link rel="stylesheet" href="{{asset("css/animate.css")}}">
<link rel="stylesheet" href="{{asset("css/nouislider.min.css")}}">
@stop

@section("top_include")
<style>

.advance_search{
  padding: 1% !important;
}

.preview-name{
  text-align: left;
  font-weight: bold;
  font-size: 18px;
}

.preview-info{
  text-align: left;
  font-size:15px;
}

.time{
  text-align: left;
  font-size:10px;
}

.card-result{
  border-bottom: 1px solid #C7CDCD;
  padding: 5% !important;
}


      #result_parent{
        display: none;
        padding-left: 0;
        padding-right: 0;
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
        font-size: 15px;
        font-weight: 300;
        margin-left: 50px;
        margin-top:10px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #gps {
        cursor:pointer;
        color: #42a5f5;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-top:10px;
        margin-right:10px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
      }

      #gps:hover{
        color: #2196f3;
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

      #result_parent{
        text-align: center;
      }

</style>
@stop


@section("bottom_include")
<script src="https://maps.googleapis.com/maps/api/js?key={{ env("MAP_API_KEY","nothing") }}&libraries=places"></script>
<script src="{{ asset("js/markerclusterer.js")}}"></script>
<script src="{{ asset("js/nouislider.min.js")}}"></script>
<script type="text/javascript">

    @if(\Session::has("error"))
      var toastHTML = '<span class="card-panel red lighten-3">{!! \Session::get("error") !!}</span>';
      M.toast({html: toastHTML});
    @endif

    var slider = document.getElementById('age-slider');
    noUiSlider.create(slider, {
     start: [0, 20],
     connect: true,
     step: 1,
     orientation: 'horizontal', // 'horizontal' or 'vertical'
     range: {
       'min': 0,
       'max': 100
     },
     format: wNumb({
       decimals: 0
     })
    });

    slider.noUiSlider.on('update', function(values){
      document.getElementById("amin").value = values[0];
      document.getElementById("amax").value = values[1];
    });

    var slide = document.getElementById('distance-slider');
    noUiSlider.create(slide, {
     start: 10,
     connect: [true,false],
     step: 1,
     behaviour: 'snap',
     orientation: 'horizontal', // 'horizontal' or 'vertical'
     range: {
       'min': 0,
       'max': 100
     },
     format: wNumb({
       decimals: 0
     })
    });

    slide.noUiSlider.on('update', function(values){
      document.getElementById("dmax").value = values[0];
    });
</script>
@stop

@section("jquery")
$('select').formSelect();

$('#pet').change(function(){
  $("#ty").empty();
  $("#ty").append("<option disabled>@lang("open_post/open.wait")</option>");
  $("#ty").prop("disabled",false);
  $("#ty").formSelect();
  $.ajax({
    url: "{{url('/api/pet')}}/"+$("#pet").val(),
    type: "get",
    success: function(result){
      var ret = $.parseJSON(result);
      $("#ty").empty();
      $("#ty").append("<option value='*'>All</option>");

      $.each(ret, function(name,val){
        $("#ty").append('<option value="'+val.id+'" >'+val.name+'</option>');
      });

      $("#ty").formSelect();
  }});
});


      var map;
      var markers = [];
      var ids = [];
      var prev;

      function showLoca(posi){
        var lat = posi.coords.latitude;
        var long = posi.coords.longitude;
        document.getElementById("lat").value = lat;
        document.getElementById("lng").value = long;
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

      $("#gps").on("click",function(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showLoca);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
      });

      // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var gps = document.getElementById('gps');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(gps);

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

      getMapBound();


    google.maps.event.addListener(map, 'idle', function() {
        getMapBound();
    });

    google.maps.event.addListener(map, 'bounds_changed', function() {
         getMapBound();
    });

    function addCard(id,name,cate,gender,age,time,image){
        var myvar = '<div class="col s12 card-result">'+

        '            <div class="col s3" style="padding-right:0">'+
        '              <img src="'+image+'" alt="" class="circle responsive-img" style="min-height:80px;">'+
        '            </div>'+
        '            <div class="col s9" style="padding-left:0">'+
        '              <div class="col s12 preview-name">'+
        '                <a href="{{ url("post")}}/'+id+'">'+name+'</a>'+
        '              </div>'+
        '              <div class="col s12 preview-info">'+
        '                '+cate+' - '+gender+' - '+age+
        '              </div>'+
        '              <div class="col s12 time">'+
        '                '+time+
        '              </div>'+
        '            </div>'+

        '        </div>';

        return myvar;
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
                            $("#result").html("<img class='wait' src='{{asset("images/loading.gif")}}' />");

                            $.ajax({
                              type: "POST",
                              url: "{{ url('api/post/detail') }}",
                              data: {data: jsn},
                              cache: false,
                              success:function(response){
                                if(response){
                                  resp = JSON.parse(response);
                                  $("#result").html("");
                                  resp.forEach(function(e){
                                    $("#result").append(addCard(e.id,e.title,e.cate,e.gender,e.age,e.date,e.link_name));
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
