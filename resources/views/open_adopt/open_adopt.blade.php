@extends("layout.index_dashboard")
@section("meta")
  <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section("top_include")
<link rel="stylesheet" href="{{asset("js/ui/trumbowyg.min.css")}}">
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 350px;
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

      .radios{
        margin: 5px;
      }

      .radios input{
        margin:5px;
      }
</style>
<script src="{{asset("js/trumbowyg.min.js")}}"></script>
@stop



@section("content")
@include("layout.menu.afterLogin")
<section>
  <div class="container">

    <div class="row">
      {{\Session::get("error")}}
      <form name="new_adopt" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="input-field col s6">
            <select name="category" id="pet">
              <option value="" disabled selected>Choose your option</option>
              @foreach($category as $a)
                <option value="{{ $a->id }}">{{ $a->name }}</option>
              @endforeach
            </select>
            <label>Pet Category</label>
          </div>
        </div>

        <div  id="pettype" style="display:none">
          <div class="row">
            <div class="col s12">
              <label>Pet type</label>
            </div>
            <div class="panel-body">
              wait..
            </div>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
            <label for="tit">Title</label>
            <input type="text" name="title" class="form-control" id="tit" placeholder="Title of the post"/>
          </div>
        </div>


        <div class="row">
          <div class="input-field col s12">
            <label for="de">Description</label>
            <textarea name="desc" id="de"></textarea>
          </div>
        </div>

        <div class="row" style="width:100%; height:100%;">
          <div class="input-field col s12">
            <label for="pac-input">Pet location</label>
            <input id="pac-input" class="controls" type="text" placeholder="Search Box">
            <div id="map"></div>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <label for="Product Name">Pet photos (can attach more than one):</label>
            <input type="file" class="form-control" name="image[]" multiple />
          </div>
        </div>
        <input type="hidden" name="lat" id="lat" />
         {{ csrf_field() }}
        <input type="hidden" name="lng" id="lng"/>

        <button type="submit" class="btn btn-primary">Create</button>
      </form>
    </div>
  </div>
</section>
@stop

@section("jquery")
$('select').formSelect();
$('#de').trumbowyg({
  btns: [
      ['viewHTML'],
      ['undo', 'redo'], // Only supported in Blink browsers
      ['formatting'],
      ['strong', 'em', 'del'],
      ['superscript', 'subscript'],
      ['link'],
      ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
      ['unorderedList', 'orderedList'],
      ['horizontalRule'],
      ['removeformat'],
      ['fullscreen']
  ],
    autogrowOnEnter: true
});
$('#pet').change(function(){
  $(".panel-body").html("wait...");
  $.ajax({
    url: "{{url('/api/pet')}}/"+$("#pet").val(),
    type: "get",
    success: function(result){
      var ret = $.parseJSON(result);
      var html = "";
      $.each(ret, function(name,val){
        html += '<div class="col s2"><label> <input type="radio" name="type" id="type'+val.id+'" value="'+val.id+'" /><span>'+val.name+'</span></label></div>';
      });

      if(html == "") html = "None";

      $(".panel-body").html(html);
  }});


  $("#pettype").show();
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
          center: {lat: -6.914744, lng: 107.609810},
          disableDefaultUI: true, // a way to quickly hide all controls
          zoom: 17,
          gestureHandling: 'greedy'
        });

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
