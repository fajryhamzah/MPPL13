@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")
<div class="row" style="height:100%">
  <div class="col s12">
    <form name="advance_finder" method="post">
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
      <input type="hidden" name="distMin" id="dmin" value="0" />
      <input type="hidden" name="distMax" id="dmax" value="10" />
    </form>
  </div>
  <div class="col s12" style="height:100%;padding:0px">
    <div class="col s12" style="height:100%;padding:0px" id="map_parent">
        <div id="map"></div>
    </div>
    <div class="col s3" id="result_parent">
      <div id="result">

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
  border-bottom: 1px solid black;
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
     start: [0, 10],
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

    slide.noUiSlider.on('update', function(values){
      document.getElementById("dmin").value = values[0];
      document.getElementById("dmax").value = values[1];
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

    function addCard(id,name,cate,gender,age,time,image){
        var myvar = '<div class="col s12 card-result">'+
        '          <div class="row">'+
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
        '          </div>'+
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
                            //$("#result").html("<img class='wait' src='{{asset("images/loading.gif")}}' />");

                            $.ajax({
                              type: "POST",
                              url: "{{ url('api/post/detail') }}",
                              data: {data: jsn},
                              cache: false,
                              success:function(response){
                                if(response){
                                  resp = JSON.parse(response);

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
