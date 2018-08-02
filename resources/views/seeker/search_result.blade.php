@extends("layout.index_dashboard")
@section("content")
  @include("layout.menu.afterLogin")
  <div class="row" style="height:100%">
    <div class="col s12 advance_search">
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
        <input type="hidden" name="distMax" id="dmax" value="10" />
        <input type="hidden" name="lat" id="lat" />
        <input type="hidden" name="lng" id="lng" />
      </form>
    </div>
    <div class="col s12" style="height:100%;padding:0px">

      <div class="row">
        @foreach($data as $d)
          <div class="col s6">
            <div class="card large">
              <div class="card-image">
                <img src="{{ asset("img/product/".$d->link_name)}}" class="responsive-img im">
                <span class="card-title">{{$d->title}} ({{$d->distance}} KM)</span>
              </div>
              <div class="card-content">
                <p>@lang("search.full",["gender" => (($d->gender == 0)? trans("search.his"):trans("search.her")), "name" => $d->title, "age"=> $d->age,"type" => $d->name] )</p>
              </div>
              <div class="card-action">

                <a href="{{ url('post/'.$d->open_adoption_id) }}">@lang("search.find_out")</a>
              </div>
            </div>
          </div>
        @endforeach
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
.resize{
  height:auto !important;
}
.im{
  max-height: 300px;
}

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
  font-size: 10px;
}

.card-result{
  border-bottom: 1px solid #C7CDCD;
  padding: 5% !important;
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


@stop
