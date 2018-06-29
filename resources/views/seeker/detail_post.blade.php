@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")
<div class="row">
  <div class="col s12" style="padding:1%">
    <div class="col s6" style="text-align:right;">
      @if($img->isNotEmpty())
          <div class="sp-loading"><img src="{{ asset("images/sp-loading.gif") }}" alt=""><br>LOADING</div>
          <div class="sp-wrap">
            @foreach($img as $i)
              <a href="{{ asset("img/product") }}/{{ $i->link_name }}"><img src="{{ asset("img/product") }}/{{ $i->link_name }}"></a>
            @endforeach
          </div>
      @else
        <div class="sp-wrap">
          <a href=""><img src="{{ asset("images/no.png") }}"></a>
        </div>
      @endif
    </div>
    <div class="col s6">
        <div class="col s6 head">
          @lang("seeker/detail.name")
        </div>
        <div class="col s6">
          {{$detail->title}}
        </div>
        <div class="col s6 head">
          @lang("seeker/detail.gender")
        </div>
        <div class="col s6">
          {{ ($detail->gender)? trans("seeker/detail.male"):trans("seeker/detail.female")}}
        </div>
        <div class="col s6 head">
          @lang("seeker/detail.type")
        </div>
        <div class="col s6">
          {{$detail->cate}}
        </div>
        <div class="col s6 head">
          @lang("seeker/detail.age")
        </div>
        <div class="col s6">
          @lang("seeker/detail.age_unit",["age" => $detail->age])
        </div>
        <div class="col s6 head">
          @lang("seeker/detail.poster")
        </div>
        <div class="col s6">
          <a href="{{url("profile/".$detail->poster_id)}}">{{$detail->name}}</a>
        </div>
        <div class="col s6 head">
          @lang("seeker/detail.date")
        </div>
        <div class="col s6">
          {{date("d M Y",strtotime($detail->post_date))}}
        </div>
        <div class="col s6 head">
          @lang("seeker/detail.description")
        </div>
        <div class="col s12">
          {!! $detail->description !!}
        </div>
        <div class="col s12">
          @if($detail->status == 0)
            <h5>@lang("seeker/detail.closed",["link" => "<a href='".url("profile/".$detail->adopter_id)."'>".$detail->adopter."</a>"])</h5>
          @else
            <a id="app" class="waves-effect waves-light btn-small"><i class="material-icons left">create</i> @lang("seeker/detail.apply")</a>
          @endif
          <a id="show" class="waves-effect waves-light btn-small light-blue darken-1"><i class="material-icons left">location_on</i> @lang("seeker/detail.show_loca")</a>
        </div>
    </div>
    <div class="col s12">
      <div id="form">
        <form name="apply" method="post">
          @if(isset($bidder_count))
            You're the owner here the Count: {{ $bidder_count }}
          @else
            {{ csrf_field() }}

            @if(isset($bidder_post))
              <span>@lang("seeker/detail.already")</span>
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="textarea1" class="materialize-textarea" name="msg">{{ $bidder_post->message  }}</textarea>
                  <label class="active" for="textarea1">@lang("seeker/detail.cover")</label>
                </div>
              </div>
            @else
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="textarea1" class="materialize-textarea" name="msg"></textarea>
                  <label for="textarea1">@lang("seeker/detail.cover")</label>
                </div>
              </div>


            @endif
            <button class="btn waves-effect waves-light" type="submit" name="action">@lang("seeker/detail.submit")
              <i class="material-icons right">send</i>
            </button>
        @endif


        </form>



      </div>
      <div id="map">
      </div>
    </div>



  </div>
</div>


@stop

@section("css")
<link rel="stylesheet" href="{{ asset("css/smoothproducts.css") }}">
<link rel="stylesheet" href="{{asset("css/animate.css")}}">
@stop

@section("top_include")
<script type="text/javascript" src="{{ asset("js/smoothproducts.min.js") }}"></script>
<style>
  .head{
    font-weight: bold;
  }
  .sp-wrap{
    width:66.6666666667%;
    float: none;
    text-align: left;
    min-width: 66.6666666667%;
  }
  #map,#form{
    display: none;
  }
  /* Always set the map height explicitly to define the size of the div
   * element that contains the map. */
  #map {
    height: 350px;
    width:100%;
  }
  /* Optional: Makes the sample page fill the window. */
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
</style>
@stop

@section("bottom_include")
<script src="https://maps.googleapis.com/maps/api/js?key={{ env("MAP_API_KEY","nothing") }}&libraries=places"></script>
<script>map = new google.maps.Map(document.getElementById('map'), {
  lat: {{$detail->lati}},
  lng: {{$detail->longi}},
  disableDefaultUI: true, // a way to quickly hide all controls
  zoom: 17,
  gestureHandling: 'greedy'
});

@if(\Session::has("success"))
    M.toast({html: 'Success',classes: "light-blue darken-1"});
@endif
@if(\Session::has("error"))
    M.toast({html: "{{ \Session::get("error")}}" ,classes: "red darken-4"});
@endif
</script>
@stop

@section("jquery")
$('.sp-wrap').smoothproducts();
var map = null;
var marker;

$("#app").on("click",function(){
  $("#form").removeClass("animated fadeOutRight");
  $("#form").css("display","block");
  $("#form").addClass("animated fadeInLeft");
  $("#map").removeClass("animated fadeInLeft");
  $("#map").addClass("animated fadeOutRight");
  $("#map").css("display","none");
});

$("#show").on("click",function(){
  $("#map").removeClass("animated fadeOutRight");
  $("#map").css("display","block");
  $("#map").addClass("animated fadeInLeft");
  $("#form").removeClass("animated fadeInLeft");
  $("#form").addClass("animated fadeOutRight");
  $("#form").css("display","none");

  if(!map){
    var latlng = new google.maps.LatLng({{$detail->lati}}, {{$detail->longi}});
    map = new google.maps.Map(document.getElementById('map'), {
      center:latlng,
      disableDefaultUI: true, // a way to quickly hide all controls
      zoom: 17,
      gestureHandling: 'greedy'
    });



    marker = new google.maps.Marker({
        position: latlng,
        animation: google.maps.Animation.DROP,
        map: map
    });
  }

});
@stop
