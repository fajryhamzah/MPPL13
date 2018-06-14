@extends("layout.index")

@section("content")
    <section id="banner">
      @include("layout.menu.home")
      <div class="row">
        <div class="col s12 center-align" id="sub-banner">
          <div class="col s8 offset-s2 white-text" id="sub-text">
            <h3>@lang("homepage.subtitle")</h3>
            <div class="col s3" id="rotate">
              <span id="rotator">@lang("homepage.title")</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="why">
      <div class="row">
        <div class="col s12 center-align">
          <h4>@lang("homepage.why")</h4>

          <div class="col s4 box wow fadeInUp" data-wow-delay="0.5s">
            <a class="hi-icon"><img src="{{asset("images/dumbbell.png")}}" /></a>
            <h6>@lang("homepage.hero")</h6>
            <div class="col s6 offset-s3">
              <span>@lang("homepage.subhero")</span>
            </div>
          </div>
          <div class="col s4 box wow fadeInUp" data-wow-delay="0.5s">
            <a class="hi-icon"><img src="{{asset("images/heartbeat.png")}}" /></a>
            <h6>@lang("homepage.save")</h6>
            <div class="col s6 offset-s3">
              <span>@lang("homepage.subsave")</span>
            </div>
          </div>
          <div class="col s4 box wow fadeInUp" data-wow-delay="0.5s">
            <a class="hi-icon"><img src="{{asset("images/cash.png")}}" /></a>
            <h6>@lang("homepage.cost")</h6>
            <div class="col s6 offset-s3">
              <span>@lang("homepage.subcost")</span>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section id="features">
        <div class="row">
          <div class="col s6">
            <h4 class="wow fadeInUp">@lang("homepage.features")</h4>

            <div class="wow fadeInUp" data-wow-delay="0.3s">
              <h5>@lang("homepage.buddy")</h5>
              <span>@lang("homepage.subbuddy")</span>
            </div>

            <div class="wow fadeInUp" data-wow-delay="0.5s">
              <h5>@lang("homepage.owner")</h5>
              <span>@lang("homepage.owner")</span>
            </div>

          </div>
          <div class="col s6 wow fadeInUp">
            <img src="{{asset("images/features.png")}}"/ />
          </div>
        </div>
    </section>

    <section id="vision">
      <div class="row">
        <div class="col s12">
          <h4>@lang("homepage.vision")</h4>

          <div class="col s6" id="kiri">
            <div class="col s4 wow flipInY" data-wow-delay="0.7s">
                <img src="{{asset("images/vision.png")}}" />
            </div>
            <div class="col s6 subspan wow fadeInRight">
                <h5>@lang("homepage.title_vision")</h5>
                <span>@lang("homepage.subvision")</span>
            </div>
          </div>

          <div class="col s6 offset-s6" id="kanan">
            <div class="col s6 subspan wow fadeInLeft">
                <h5>@lang("homepage.mission")</h5>
                <span>@lang("homepage.submission")</span>
            </div>
            <div class="col s3 wow flipInY" data-wow-delay="0.7s">
                <img src="{{asset("images/mission.png")}}" />
            </div>
          </div>

        </div>
      </div>
    </section>

    <section id="interest">
      <div class="row" style="margin-bottom:0">
        <div class="col s12 center-align">
            <h4 class="wow fadeInUp">@lang("homepage.interested")</h4>

            <div class="col s12 wow fadeInUp" data-wow-delay="0.3s">
              <span>@lang("homepage.sub_inte")</span>
              <a class="btn nav-button" href="{{ url("register") }}">@lang("homepage.bottom_join")</a>
            </div>
        </div>
      </div>
    </section>
@stop

@section("top_include")
<link rel="stylesheet" href="{{asset("css/morphext.css")}}">
<script src="{{asset("js/morphext.min.js")}}"></script>
@stop

@section("jquery")
$("#rotator").Morphext({
    // The [in] animation type. Refer to Animate.css for a list of available animations.
    animation: "fadeInDown",
    // An array of phrases to rotate are created based on this separator. Change it if you wish to separate the phrases differently (e.g. So Simple | Very Doge | Much Wow | Such Cool).
    separator: ",",
    // The delay between the changing of each phrase in milliseconds.
    speed: 2000,
});
@stop
