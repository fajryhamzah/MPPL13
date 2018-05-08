@extends("layout.index_dashboard")

@section("meta")
  <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section("top_include")
<link rel="stylesheet" type="text/css" href="{{ url("css/bootstrap3-wysihtml5.min.css") }}"></link>
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
@stop

@section("content")
@include("layout.menu.afterLogin")
<section class="sec">
  <div class="container">
    <div class="row">
      {{\Session::get("error")}}
      <form name="new_adopt" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="pet">Pet Category</label>
          <select name="category" id="pet" class="form-control">
            <option value="" selected disabled>Please select</option>
            @foreach($category as $a)
              <option value="{{ $a->id }}" {{ ( ($data->category_pet == $a->id) || ($cate->parent_id == $a->id)) ? "selected":"" }}>{{ $a->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="panel panel-default" id="pettype" >
          <div class="panel-heading">
            <h3 class="panel-title">Pet type</h3>
          </div>
          <div class="panel-body">
            @foreach($child as $a)
              <label class="radios"> <input type="radio" name="type" id="type{{$a->id}}" value="{{$a->id}}" {{ ($data->category_pet == $a->id) ? "checked":"" }}>{{$a->name}}</label>
            @endforeach
          </div>
        </div>
        <div class="form-group">
          <label for="tit">Title</label>
          <input type="text" name="title" class="form-control" id="tit" placeholder="Title of the post" value="{{$data->title}}"/>
        </div>
        <div class="form-group">
          <label for="de">Description</label>
          <textarea name="desc" id="de" style="width: 100%">{{$data->description}}</textarea>
        </div>
        <div class="form-group" style="width:100%; height:100%;">
          <label for="pac-input">Pet location</label>
          <input id="pac-input" class="controls" type="text" placeholder="Search Box">
          <div id="map"></div>
        </div>
        <div class="form-group">
          <label for="Product Name">Pet photos (can attach more than one):</label>
          <input type="file" class="form-control" name="image[]" multiple />
        </div>
        <div class="row">
          @foreach($img as $a)
            <div class="col-sm-4 col-md-3" id="im{{$a->id}}">
              <div class="thumbnail">
                <img src="{{ asset("")."/img/product/".$a->link_name }}" style="width:100%;height:200px">
                <div class="caption">
                  <p><button type="button" class="btn btn-danger" onClick="deleteImg({{ $a->id }})">Delete</button></p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <input type="hidden" name="lat" id="lat" value="{{$data->lati}}" />
        <input type="hidden" name="img_before" id="img_bef" value="{{ $img_list }}" />
         {{ csrf_field() }}
        <input type="hidden" name="lng" id="lng" value="{{$data->longi}}"/>
        <input type="hidden" name="id" value="{{$data->id}}"/>
        <button type="submit" class="btn btn-primary">Edit</button>
      </form>
    </div>
  </div>
</section>
@stop




@section("bottom_include")
<script src="{{ url("js/bootstrap3-wysihtml5.all.min.js") }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env("MAP_API_KEY","nothing") }}&libraries=places"></script>
<script>
$(document).ready(function(){
  var img_list = {{ $img_list }}

  deleteImg = function(id){
    $("#im"+id).remove();

    img_list = img_list.filter(function(item){
        return item != id;
    });

    $("#img_bef").val(img_list);
  }

  $('#pet').change(function(){
    $(".panel-body").html("wait...");
    $.ajax({
      url: "{{url('/api/pet')}}/"+$("#pet").val(),
      type: "get",
      success: function(result){
        var ret = $.parseJSON(result);
        var html = "";
        $.each(ret, function(name,val){
          console.log(val);
          html += '<label class="radios"> <input type="radio" name="type" id="type'+val.id+'" value="'+val.id+'">'+val.name+'</label>';
        });

        if(html == "") html = "None";

        $(".panel-body").html(html);
    }});


    $("#pettype").show();
  });

  $('#de').wysihtml5({
    toolbar: {
                "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
                "emphasis": true, //Italics, bold, etc. Default true
                "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                "html": false, //Button which allows you to edit the generated HTML. Default false
                "link": true, //Button to insert a link. Default true
                "image": false, //Button to insert an image. Default true,
                "color": false, //Button to change color of font
                "blockquote": true, //Blockquote
                "fa": true,
              }
  });



})

</script>
<script>
      var map;
      var lat;
      var long;
      var marker = null;




        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: {{$data->lati}}, lng: {{$data->longi}}},
          disableDefaultUI: true, // a way to quickly hide all controls
          zoom: 17,
          gestureHandling: 'greedy'
        });

        lat = {{$data->lati}};
        long = {{$data->longi}};
        var myLatlng = new google.maps.LatLng(lat,long);
        setLatLng();
        map.setCenter(myLatlng)
        placeMarker(myLatlng);

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
