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
                      <span>@lang("profile/profile.post_date") {{date("d/m/Y",strtotime($a->get("post_date")))}}</span>
                      <span>{{$a->get("name")}} {{ ($a->has("parent_category"))? "(".$a->get("parent_category").")":"" }}</span>
                    </div>
                  @endforeach
                    <div class="col s5 seemore">
                      see more
                    </div>
                </div>
                <div id="adopted" class="col s12">
                  @foreach($adopted as $a)
                    <div class="col s12 left-align">
                      <a href="post/{{$a->get("id")}}">{{$a->get("title")}}</a>
                      <span>@lang("profile/profile.gender") {{($a->get("gender") == 0)? trans("profile/profile.male"):trans("profile/profile.female")}} </span>
                      <span>@lang("profile/profile.age") {{$a->get("gender")}} @lang("profile/profile.age_unit")</span>
                      <span>@lang("profile/profile.post_date") {{date("d/m/Y",strtotime($a->get("post_date")))}}</span>
                      <span>{{$a->get("name")}} {{ ($a->has("parent_category"))? "(".$a->get("parent_category").")":"" }}</span>
                    </div>
                  @endforeach
                    <div class="col s5 seemore">
                      see more
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




@stop
