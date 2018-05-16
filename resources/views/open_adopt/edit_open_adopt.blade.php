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
<section class="sec">
  <div class="container">
    <div class="row">
      {{\Session::get("error")}}
      <form name="edit_adopt" method="post" id="open_post" enctype="multipart/form-data">
        <div class="row">
          <div class="input-field col s6">
            <select name="category" id="pet">
              <option value="" disabled selected>@lang("open_post/open.choose")</option>
              @foreach($category as $a)
                <option value="{{ $a->id }}" {{ ( ($data->category_pet == $a->id) || ($cate->parent_id == $a->id)) ? "selected":"" }}>{{ $a->name }}</option>
              @endforeach
            </select>
            <label>@lang("open_post/open.cate")</label>
          </div>
        </div>

        <div  id="pettype">
          <div class="row">
            <div class="col s12">
              <label>@lang("open_post/open.type")</label>
            </div>
            <div class="panel-body">
              @foreach($child as $a)
                <div class="col s2"><label>
                  <input type="radio" name="type" id="type{{$a->id}}" value="{{$a->id}}" {{ ($data->category_pet == $a->id) ? "checked":"" }}/>
                  <span>{{$a->name}}</span>
                </label>
              </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
            <label for="tit">@lang("open_post/open.title")</label>
            <input type="text" name="title" class="form-control" id="tit" placeholder="@lang("open_post/open.title_holder")" value="{{$data->title}}"/>
          </div>
        </div>


        <div class="row">
          <div class="input-field col s12">
            <span>@lang("open_post/open.desc")</span>
            <textarea name="desc" id="de">{{$data->description}}</textarea>
          </div>
        </div>

        <div class="row" style="width:100%; height:100%;">
          <div class="input-field col s12">
            <span>@lang("open_post/open.loca")</span>
            <input id="pac-input" class="controls" type="text" placeholder="@lang("open_post/open.loca_holder")">
            <div id="map"></div>
          </div>
        </div>

        <div class="row">
          <div class="file-field input-field">
            <div>
              <span>@lang("open_post/open.photos")</span>
            </div>
            <div class="btn">
              <span>@lang("open_post/open.upload")</span>
              <input type="file" name="image[]" id="uplo" multiple>
            </div>
            <div class="file-path-wrapper" style="display:none">
              <input class="file-path validate" type="text">
            </div>
          </div>
        </div>
        <div class="row" id="preview">

        </div>

        <div class="row">
          <div class="col s12">
            <span>@lang("open_post/open.saved_image")</span>
          </div>
          @foreach($img as $a)
          <div class="col s3" style="width:350px;" id="im{{$a->id}}">
            <div class="card">
              <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="{{ asset("")."/img/product/".$a->link_name }}" style="width:350px;height:350px;">
              </div>
              <div class="card-action">
                <button type="button" class="waves-effect waves-light btn red darken-4" onClick="deleteImg('{{ $a->id }}')">@lang("open_post/open.remove")</button>
                <button type="button" class="waves-effect waves-light btn setas {{ ($a->is_featured == 1)? "disabled":""}}" id="sv{{ $a->id }}" onClick ="setasSaved('{{ $a->id }}')">@lang("open_post/open.set_as")</button>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <input type="hidden" name="lat" id="lat" />
         {{ csrf_field() }}
        <input type="hidden" name="lng" id="lng"/>
        <input type="hidden" name="featured" id="fea" value="{{ $img_id }}"/>
        <input type="hidden" name="featuredMode" id="feam" value="{{ $img_mode }}"/>
        <input type="hidden" name="img_list" id="myHack"/>
        <input type="hidden" name="id" value="{{$data->id}}"/>
        <input type="hidden" name="img_before" id="img_bef" value="{{ $img_list }}" />
        <div class="row">
          <button type="submit" class="btn btn-primary" id="sub">@lang("open_post/open.save")</button>
        </div>
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
var inc = 0;
function addCard(files){
  i = inc;
  var a = '<div class="col s3" style="width:350px;" id="c'+i+'"><div class="card"><div class="card-image waves-effect waves-block waves-light"><img class="activator" src="'+files.target.result+'" style="width:350px;height:350px;"></div><div class="card-action"><button type="button" class="waves-effect waves-light btn red darken-4" onClick="deleteCard(\''+i+'\')">@lang("open_post/open.remove")</button><button type="button" class="waves-effect waves-light btn setas" id="s'+i+'" onClick ="setas(\''+i+'\')">@lang("open_post/open.set_as")</button></div></div></div>';
  $("#preview").append(a);
  inc += 1;
}

setas = function(id){
  $(".setas").removeClass("disabled");
  $("#s"+id).addClass("disabled");
  $("#fea").val(img[id].name);
  $("#feam").val('1');
}

setasSaved = function(id){
  $(".setas").removeClass("disabled");
  $("#sv"+id).addClass("disabled");
  $("#fea").val(id);
  $("#feam").val('0');
}

deleteCard = function(id){
  $("#c"+id).hide('slow', function(){ $(this).remove(); });
  img[id] = null;
}

var img = [];
$("#uplo").on("change",function(evt){
  $("#preview").html('');
  img = [];
  inc = 0;
  for(var i = 0, f; f = evt.target.files[i]; i++){
    img.push(f);
    var reader = new FileReader();
    reader.onload = function(e) {
      addCard(e);
    }
    reader.readAsDataURL(f);
  }
});

$("#sub").on("click",function(e){
  e.preventDefault();
  var imgName = {};

  img.forEach(function(e,i){
    if(e){
      imgName[i] = e.name;
    }

  });


  var im = JSON.stringify(imgName);
  $("#myHack").val(im);
  document.getElementById("open_post").submit();
});

var img_list = {{ $img_list }}

deleteImg = function(id){
  $("#im"+id).hide('slow', function(){ $(this).remove(); });

  img_list = img_list.filter(function(item){
      return item != id;
  });

  $("#img_bef").val(img_list);
}

@stop

@section("bottom_include")
<script src="https://maps.googleapis.com/maps/api/js?key={{ env("MAP_API_KEY","nothing") }}&libraries=places"></script>
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
