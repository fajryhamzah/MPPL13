@extends("layout.index_dashboard")
@section("meta")
  <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section("top_include")
<link rel="stylesheet" href="{{asset("js/ui/trumbowyg.min.css")}}">
<link rel="stylesheet" href="{{asset("css/ezdz.min.css")}}">
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
        margin-top:10px;
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

      .btn{
        float:none !important;
        margin: 5px 5px 5px 0px;
        border-radius: 50px;
      }

      .card-action{
        padding: 0px !important;

      }
</style>
<script src="{{asset("js/trumbowyg.min.js")}}"></script>
<script src="{{asset("js/ezdz.min.js")}}"></script>
@stop



@section("content")
@include("layout.menu.afterLogin")
<section>
  <div class="container" style="width:80%;margin-top:2%">
    <div class="row">
      <div class="col s8 offset-s2">
        <form name="edit_adopt" method="post" id="open_post" enctype="multipart/form-data">
          <div class="row">
            <div class="input-field col s5">
              @if(\Session::get("error"))
                @if(\Session::get("error")->has("category"))
                  <span style="color:#d32f2f;display:block">@lang("open_post/open.error_cate")</span>
                @endif
              @endif
              <select name="category" id="pet">
                <option value="" disabled selected>@lang("open_post/open.choose")</option>
                @foreach($category as $a)
                  <option value="{{ $a->id }}" {{ ( ($data->category_pet == $a->id) || ($cate->parent_id == $a->id)) ? "selected":"" }}>{{ $a->name }}</option>
                @endforeach
              </select>
              <label>@lang("open_post/open.cate")</label>
            </div>

            <div id="pettype" class="input-field col s5 offset-s1">
              @if(\Session::get("error"))
                @if(\Session::get("error")->has("category"))
                  <span style="color:#d32f2f;display:block">@lang("open_post/open.error_cate")</span>
                @endif
              @endif
              <select name="type" id="ty" disabled>
                <option value="" disabled selected>@lang("open_post/open.choose")</option>
                @foreach($child as $a)
                    <option name="type" value="{{$a->id}}" {{ ($data->category_pet == $a->id) ? "selected":"" }}>{{$a->name}}</option>
                @endforeach
              </select>
              <label>@lang("open_post/open.type")</label>
            </div>

          </div>

          <div class="row">
            <div class="input-field col s5">
              <label for="tit">@lang("open_post/open.title")</label>
              <input type="text" name="title" class="form-control" id="tit" placeholder="@lang("open_post/open.title_holder")" value="{{$data->title}}"/>
              <span class="helper-text red-text text-darken-4">{{ (\Session::get("error"))? \Session::get("error")->first("title") :"" }}</span>
            </div>

            <div class="input-field col s5 offset-s1">
              <select name="gender">
                <option value="0" {{($data->gender == 0)? "selected":""}}>@lang("open_post/open.male")</option>
                <option value="1" {{($data->gender == 1)? "selected":""}}>@lang("open_post/open.female")</option>
              </select>
              <label>@lang("open_post/open.gender")</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s3">
              <label for="age">@lang("open_post/open.age")</label>
              <input type="number" id="age" name="age" min="0" max="360" value="{{$data->age}}"/>
              <span class="helper-text" style="display:inline;">@lang("open_post/open.age_helper")</span>
            </div>
          </div>


          <div class="row" style="margin-bottom:0;">
            <div class="input-field col s12">
              <span>@lang("open_post/open.desc")</span>
              <textarea name="desc" id="de">{{$data->description}}</textarea>
              <span class="helper-text red-text text-darken-4">{{ (\Session::get("error"))? \Session::get("error")->first("desc") :"" }}</span>
            </div>
          </div>

          <div class="row" style="width:100%; height:100%;">
            <div class="input-field col s12">
              @if(\Session::get("error"))
                @if(\Session::get("error")->has("lat"))
                  <span style="color:#d32f2f;display:block">@lang("open_post/open.error_map")</span>
                @endif
              @endif
              <span class="helper">@lang("open_post/open.loca")</span>
              <input id="pac-input" class="controls" type="text" placeholder="@lang("open_post/open.loca_holder")">
              <div id="map"></div>
            </div>
          </div>

          <div class="row">
            <div class="file-field input-field col s12">
              <div>
                <span class="helper">@lang("open_post/open.photos")</span>
              </div>
              <input type="file" name="image[]" id="uplo" multiple class="col s12">
              <div class="file-path-wrapper" style="display:none">
                <input class="file-path validate" type="text">
              </div>
            </div>

            @foreach($img as $a)
            <div class="col s3" style="width:350px;" id="im{{$a->id}}">
              <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                  <img class="activator" src="{{ asset("")."/img/product/".$a->link_name }}" style="width:350px;height:350px;">
                </div>
                <div class="card-action">
                  <button type="button" class="waves-effect waves-light btn red darken-4" onClick="deleteImg('{{ $a->id }}')">@lang("open_post/open.remove")</button>
                  <button type="button" class="waves-effect waves-light btn setas {{ ($a->is_featured == 1)? "disabled":""}}" id="s{{ $a->id }}" onClick ="setas('{{ $a->id }}')">@lang("open_post/open.set_as")</button>
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
            <div class="col s12" style="text-align:center">
              <button type="submit" class="btn btn-primary" id="sub" style="border-radius:0">@lang("open_post/open.create")</button>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
</section>
@stop

@section("jquery")
$('select').formSelect();
$('#uplo').ezdz({
  text: "@lang("open_post/open.drop_image")",
  previewImage: false,
});

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
      var html = "";
      $("#ty").append('<option disabled selected>@lang("open_post/open.choose")</option>');
      $.each(ret, function(name,val){
        html += val.id;
        $("#ty").append('<option value="'+val.id+'" >'+val.name+'</option>');
      });

      if(html == "") $("#ty").append('<option disabled>None</option>');

      $("#ty").formSelect();
  }});
});
var inc = 0;

function addCard(files){
  i = inc;
  var a = '<div class="col s3" style="width:300px;" id="c'+i+'"><div class="card"><div class="card-image waves-effect waves-block waves-light"><img class="activator" src="'+files.target.result+'"></div><div class="card-action"><button type="button" class="waves-effect waves-light btn setas" id="s'+i+'" onClick ="setas(\''+i+'\')">@lang("open_post/open.set_as")</button><button type="button" class="waves-effect waves-light btn red darken-4" onClick="deleteCard(\''+i+'\')">@lang("open_post/open.remove")</button></div></div></div>';
  $("#ezdz_prev").append(a);
  inc += 1;
}

setas = function(id){
  $(".setas").removeClass("disabled");
  $("#s"+id).addClass("disabled");

  if(!(id in img)){
    $("#fea").val(id);
    $("#feam").val('0');
  }
  else{
    $("#fea").val(img[id].name);
    $("#feam").val('1');
  }
}

deleteCard = function(id){
  $("#c"+id).hide('slow', function(){ $(this).remove(); });
  img[id] = null;
}
var img = [];

$("#uplo").on("change",function(evt){
  $("#ezdz_prev").remove();
  $(".ezdz-dropzone").append("<div id='ezdz_prev'></div>");
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

var img_list = {{ $img_list }}

deleteImg = function(id){
  $("#im"+id).hide('slow', function(){ $(this).remove(); });

  img_list = img_list.filter(function(item){
      return item != id;
  });

  $("#img_bef").val(img_list);
}

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

@stop



@section("bottom_include")
<script src="https://maps.googleapis.com/maps/api/js?key={{ env("MAP_API_KEY","nothing") }}&libraries=places"></script>
</script>
<script>
      var map;
      var lat;
      var long;
      var marker = null;

      //map
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
