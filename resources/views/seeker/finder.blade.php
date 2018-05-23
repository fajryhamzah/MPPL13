@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")
  <section>
    <div class="container" style="margin-top:2%;">
      <div class="row">
        {{\Session::get("error")}}
        <div class="col s12">
              <form name="editProf" method="post" enctype="multipart/form-data">

                <div class="row">
                  <div class="input-field col s6">
                    <select name="category" id="pet">
                      <option value="" disabled selected>@lang("open_post/open.choose")</option>
                      @foreach($category as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
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
                      <div class="col s2">
                        @lang("open_post/open.fill_first")
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s6">
                    <select name="radius" id="pet">
                      <option value="" disabled selected>@lang("seeker/finder.radius")</option>
                      <option value="1"><= 1 KM</option>
                      <option value="3"><= 3 KM</option>
                      <option value="5"><= 5 KM</option>
                      <option value="6">>= 5 KM</option>
                    </select>
                    <label>@lang("open_post/open.cate")</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12">
                    <div class="col s6">
                      <span>@lang("seeker/finder.preferences_loc") : </span>
                      <label>
                        <input type="radio" name="pref" value="saved" id="saved" checked/>
                        <span>@lang("seeker/finder.saved_loc")</span>
                      </label>
                      <label>
                        <input type="radio" name="pref" value="current" id="current" />
                        <span>@lang("seeker/finder.current_loc")</span>
                      </label>
                    </div>
                  </div>
                </div>
                @if(!$lati)
                  <span>@lang("seeker/finder.set_loc")</span>
                @endif
                 {{ csrf_field() }}
                <input type="hidden" name="lat" id="lat" value="{{ $lati }}"/>
                <input type="hidden" name="lng" id="lng" value="{{ $longi }}"/>
                  <div class="row">
                    <div class="input-field col s6">
                      <button type="submit" class="btn btn-primary disabled" id="sub">@lang("seeker/finder.search_button")</button>
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

var currentLatitude = {{ $lati or "null" }};
var currentLongitude = {{ $longi or "null" }};
var lat;
var long;

if($("#lat").val()) $("#sub").removeClass("disabled");

$('#lat').trigger('contentchanged');

$("#lat").on('contentchanged', function() {
    if($(this).val()) $("#sub").removeClass("disabled");
});

$("#saved").on("click",function(){
  $("#lat").val(currentLatitude);
  $("#lng").val(currentLongitude);
});

function showLoca(posi){
  lat = posi.coords.latitude;
  long = posi.coords.longitude;
  console.log(lat);
  console.log(long);
}

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showLoca);
} else {
    alert("Geolocation is not supported by this browser.");
}

$("#current").on("click",function(){
  $("#lat").val(lat);
  $("#lng").val(long);
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

      if(html == ""){
        html = "None";
      }
      else{
        html = '<div class="col s2"><label> <input type="radio" name="type" id="typeall" value="*" checked/><span>All</span></label></div>'+html;
      }

      $(".panel-body").html(html);
  }});

  $("#pettype").show();
});


@stop
