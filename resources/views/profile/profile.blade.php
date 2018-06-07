@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")
  <section>
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="col s12 center-align">
              <img src="{{ ($profile->img)? asset("img/avatar/".$profile->img) : asset("images/default.png") }}" class="responsive-img">
              <h5>{{ ($profile->name)? $profile->name:$profile->username}}</h5>
              <span>Joined : {{ date("d/m/Y",strtotime($profile->registOn)) }}</span><br />
              <span id="bio">{{$profile->bio}}</span>

              <div class="col s12">
                <ul class="tabs">
                  <li class="tab col s3"><a class="post" href="#post">@lang("profile/profile.post")</a></li>
                  <li class="tab col s3"><a class="adopted" href="#adopted">@lang("profile/profile.adopted")</a></li>
                  <li class="tab col s3"><a class="adopting" href="#adopting">@lang("profile/profile.adopting")</a></li>
                </ul>
                <!-- content -->
                <div id="post" class="col s12">
                  @foreach($post as $a)
                    <div class="col s12 left-align">
                      <a href="post/{{$a->get("id")}}">{{$a->get("title")}}</a>
                      <span>@lang("profile/profile.gender") {{($a->get("gender") == 0)? trans("profile/profile.male"):trans("profile/profile.female")}} </span>
                      <span>@lang("profile/profile.age") {{$a->get("gender")}} @lang("profile/profile.age_unit")</span>
                      <span>@lang("profile/profile.post_date") {{$a->get("post_date")}}</span>
                      <span>{{$a->get("name")}} {{ ($a->has("parent_category"))? "(".$a->get("parent_category").")":"" }}</span>
                    </div>
                  @endforeach
                  <div class="col s5 seemore pst">
                    <span style='display:none'>wait</span>
                    <a href="#" class="btn seemore_post">See more</a>
                  </div>
                </div>

                <div id="adopted" class="col s12">
                  @foreach($adopted as $a)
                    <div class="col s12 left-align">
                      <a href="post/{{$a->get("id")}}">{{$a->get("title")}}</a>
                      <span>@lang("profile/profile.gender") {{($a->get("gender") == 0)? trans("profile/profile.male"):trans("profile/profile.female")}} </span>
                      <span>@lang("profile/profile.age") {{$a->get("gender")}} @lang("profile/profile.age_unit")</span>
                      <span>@lang("profile/profile.post_date") {{$a->get("post_date")}}</span>
                      <span>{{$a->get("name")}} {{ ($a->has("parent_category"))? "(".$a->get("parent_category").")":"" }}</span>
                    </div>
                  @endforeach
                    <div class="col s5 seemore">
                      <a href="{{url("api/profile/adopted/2")}}" class="btn seemore_adopted">See more</a>
                    </div>
                </div>
                <div id="adopting" class="col s12"></div>
              </div>



          </div>
        </div>
      </div>
    </div>
  </section>
@stop

@section("jquery")
  $('.tabs').tabs();
  page = 2;
  id={{$id}};

  $(".seemore_post").on("click",function(e){
    e.preventDefault();

    $(".pst span").show();
    $(this).hide();
    $.ajax({
      url: "{{ url("api/post/list/".$id) }}/"+page,
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

  $(".seemore_adopted").on("click",function(){

  });

  function addPost(a){
    var gender = (a.gender == 0)? "@lang("profile/profile.male")":"@lang("profile/profile.female")";
    var category = (a.parent_category)? a.parent_category:"";
    return '<div class="col s12 left-align">'+
        '<a href="{{ url('post/'.$a->get("id")) }}">'+a.title+'</a>'+
        '<span>@lang("profile/profile.gender") '+gender+' </span>'+
        '<span>@lang("profile/profile.age") '+a.age+' @lang("profile/profile.age_unit")</span>'+
        '<span>@lang("profile/profile.post_date") '+a.post_date+'</span>'+
        '<span>'+a.name+' '+category+'</span>'+
      '</div>';
  }

@stop

@section("bottom_include")


@stop
