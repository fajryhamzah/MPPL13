@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")
  <section>
      <div class="row">
        <div class="col s12 center-align" style="margin-top:3%;">
          <div class="col s5">
            <div class="col s6 profile" style="float:right;padding:5%">
              <div class="col s12" style="margin:0 auto;float:none;">
                <img src="{{ ($profile->img)? asset("img/avatar/".$profile->img) : asset("images/default.png") }}" class="responsive-img">
              </div>
              <h5>{{ ($profile->name)? $profile->name:$profile->username}}</h5>
              <span>@lang("profile/profile.joined",["date" => date("d F Y",strtotime($profile->registOn))])</span><br />
              <span id="bio">{{$profile->bio}}</span>
            </div>

          </div>
          <div class="col s6">
            <div class="col s12">
              <ul class="tabs">
                <li class="tab col s4"><a class="posta" href="#posta">@lang("profile/profile.post")</a></li>
                <li class="tab col s4"><a class="adopted" href="#adopted">@lang("profile/profile.adopted")</a></li>
                <li class="tab col s4"><a class="adopting" href="#adopting">@lang("profile/profile.adopting")</a></li>
              </ul>
              <!-- content -->
              <div id="posta" class="col s12 left-align">
                @foreach($post as $a)
                  <div class="col s12 post">
                    <div class="col s8">
                      <div class="col s2">
                        <img src="{{ $a->get("link_name") }}" class="circle" />
                      </div>
                      <div class="col s8 info">
                        <div class="col s12">
                          <span class="name"><a href="{{ url("post/".$a->get("id"))}}">{{$a->get("title")}}</a></span>
                          <span class="date">{{$a->get("post_date")}}</span>
                        </div>
                        <div class="col s12">
                          <span class="sub">{{$a->get("name")}} - {{($a->get("gender") == 0)? trans("profile/profile.male"):trans("profile/profile.female")}}, {{$a->get("age")}} @lang("profile/profile.age_unit")</span>
                        </div>
                      </div>
                    </div>
                    <div class="col s4 center-align parent-div">
                      <span class="parent">{{ ($a->has("parent_category"))? $a->get("parent_category"):$a->get("name") }}</span>
                    </div>
                  </div>
                @endforeach

                <div class="col s12 seemore pst center-align">
                  <span style='display:none'><img class='wait' src='{{asset("images/loading.gif")}}' /></span>
                  <a href="#" class="seemore_post">See more</a>
                </div>
              </div>

              <div id="adopted" class="col s12 left-align">
                @foreach($adopted as $a)
                  <div class="col s12 post">
                    <div class="col s8">
                      <div class="col s2">
                        <img src="{{ $a->get("link_name") }}" class="circle" />
                      </div>
                      <div class="col s8 info">
                        <div class="col s12">
                          <span class="name"><a href="{{ url("post/".$a->get("id")) }}">{{$a->get("title")}}</a></span>
                          <span class="date">{{$a->get("post_date")}}</span>
                        </div>
                        <div class="col s12">
                          <span class="sub">{{$a->get("name")}} - {{($a->get("gender") == 0)? trans("profile/profile.male"):trans("profile/profile.female")}}, {{$a->get("age")}} @lang("profile/profile.age_unit")</span>
                        </div>
                      </div>
                    </div>
                    <div class="col s4 center-align parent-div">
                      <span class="parent">{{$a->get("apply_at")}}</span>
                    </div>
                  </div>
                @endforeach

                  <div class="col s12 seemore adp center-align">
                    <span style='display:none'><img class='wait' src='{{asset("images/loading.gif")}}' /></span>
                    <a href="#" class="seemore_adopted">See more</a>
                  </div>
              </div>

              <div id="adopting" class="col s12">
                @foreach($adopting as $a)
                  <div class="col s12 post">
                    <div class="col s8">
                      <div class="col s2">
                        <img src="{{ $a->get("link_name") }}" class="circle" />
                      </div>
                      <div class="col s8 info">
                        <div class="col s12">
                          <span class="name"><a href="{{ url("post/".$a->get("id")) }}">{{$a->get("title")}}</a></span>
                          <span class="date">{{$a->get("post_date")}}</span>
                        </div>
                        <div class="col s12">
                          <span class="sub">{{$a->get("name")}} - {{($a->get("gender") == 0)? trans("profile/profile.male"):trans("profile/profile.female")}}, {{$a->get("age")}} @lang("profile/profile.age_unit")</span>
                        </div>
                      </div>
                    </div>
                    <div class="col s4 center-align parent-div">
                      <span class="parent">{{$a->get("apply_at")}}</span>
                    </div>
                  </div>
                @endforeach

                  <div class="col s12 seemore adt center-align">
                    <span style='display:none'><img class='wait' src='{{asset("images/loading.gif")}}' /></span>
                    <a href="#" class="seemore_adopting">See more</a>
                  </div>
              </div>
            </div>

          </div>

        </div>
      </div>
  </section>
@stop

@section("top_include")
<style>
.tabs .tab a:hover, .tabs .tab a.active{
  color:#039be5 !important;
}

.tabs .tab a:focus, .tabs .tab a:focus.active{
  background-color: white !important;
}

.tab a{
  color:#363636 !important;
}

.indicator{
  background-color: white !important;
}

.profile,.tabs{
  border:1px solid #C7CDCD;
}

.parent-div{
  margin-top: 2%;
}

.circle{
  width: 70px;
  height: 70px;
}

.post{
  margin:1%;
}

.info{
  margin-top:2%;
}

.parent{
   text-transform: uppercase;
}

.name a,.parent{
  color:#262626;
  font-weight: bold;
}

.date,.sub{
  color:#969696;
}
</style>
@stop

@section("jquery")
  $('.tabs').tabs();
  page = page1 = 2;
  id={{$id}};

  $(".seemore_post").on("click",function(e){
    e.preventDefault();

    $(".pst span").show();
    $(this).hide();
    $.ajax({
      url: "{{ url("api/post/list/".$id) }}/"+page+"/0/",
      success: function(result){
        page += 1;
        result = JSON.parse(result);

        //if empty
        if(result.length == 0){
          $(".pst span").html("no more");
        }
        else{
          result.forEach(function(a){
            $(addPost(a)).insertBefore(".pst");
          });

          $(".pst span").hide();
          $(".seemore_post").show();
        }

      }
    });

  });

  $(".seemore_adopted").on("click",function(e){
    e.preventDefault();

    $(".adp span").show();
    $(this).hide();
    $.ajax({
      url: "{{ url("api/post/list/".$id) }}/"+page+"/1/",
      success: function(result){
        page1 += 1;
        result = JSON.parse(result);

        //if empty
        if(result.length == 0){
          $(".adp span").html("no more");
        }
        else{
          result.forEach(function(a){
            $(addPost(a)).insertBefore(".adp");
          });

          $(".adp span").hide();
          $(".seemore_adopted").show();
        }
      }

    });



  });

  $(".seemore_adopting").on("click",function(e){
    e.preventDefault();

    $(".adt span").show();
    $(this).hide();
    $.ajax({
      url: "{{ url("api/post/list/".$id) }}/"+page+"/2/",
      success: function(result){
        page1 += 1;
        result = JSON.parse(result);

        //if empty
        if(result.length == 0){
          $(".adt span").html("no more");
        }
        else{
          result.forEach(function(a){
            $(addPost(a)).insertBefore(".adt");
          });

          $(".adt span").hide();
          $(".seemore_adopting").show();
        }
      }

    });
  });

  function addPost(a){
    var gender = (a.gender == 0)? "@lang("profile/profile.male")":"@lang("profile/profile.female")";
    var category = (a.parent_category)? a.parent_category:a.name;

    var myvar = '<div class="col s12 post">'+
    '                    <div class="col s8">'+
    '                      <div class="col s2">'+
    '                        <img src="'+a.link_name+'" class="circle" />'+
    '                      </div>'+
    '                      <div class="col s8 info">'+
    '                        <div class="col s12">'+
    '                          <span class="name"><a href="post/'+a.id+'">'+a.title+'</a></span>'+
    '                          <span class="date">'+a.post_date+'</span>'+
    '                        </div>'+
    '                        <div class="col s12">'+
    '                          <span class="sub">'+a.name+' - '+gender+', '+a.age+' @lang("profile/profile.age_unit")</span>'+
    '                        </div>'+
    '                      </div>'+
    '                    </div>'+
    '                    <div class="col s4 center-align">'+
    '                      <span class="parent">'+category+'</span>'+
    '                    </div>'+
    '                  </div>';


    return myvar;
  }

@stop

@section("bottom_include")


@stop
