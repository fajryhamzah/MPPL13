@extends("layout.index")

@section("content")
@if(\Session::has("id"))
  @include("layout.menu.afterLogin")
@else
  @include("layout.menu.home")
@endif
die("asfsafsa");
    <section id="banner" class="wow fadeInUp">
        <div class="container">
            <div class="row">

                <div class="col-md-4 col-sm-6">
                    <div class="block">
                        <img class="app-img img-responsive" src="images/app.png" alt="">
                    </div>

                </div>
                <div class="col-md-6 col-md-offset-1 col-sm-6">
                    <div class="block">
                        <h1>
                            @lang("homepage.title")
                        </h1>
                        <p>
                            @lang("homepage.subtitle")
                        </p>

                        <ul class="download-btn">
                            <li>
                                <a href="{{ url("register") }}" class="btn btn-default btn-andriod">@lang("homepage.top_join")</a>
                            </li>
                            <li>
                                <a href="{{ url("login") }}" class="btn btn-default btn-windows">@lang("homepage.top_login")</a>
                            </li>
                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="service">
        <div class="container">
            <div class="service-wrapper">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-2">
                        <div class="block wow fadeInRight" data-wow-delay="1s">
                            <div class="icon">
                               <i class="fa fa-users"></i>
                            </div>

                            <h3>@lang("homepage.buddy")</h3>
                            <p>@lang("homepage.subbuddy")</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="block wow fadeInRight" data-wow-delay="1.3s">
                            <div class="icon">
                                <i class="fa fa-home"></i>
                            </div>
                            <h3>@lang("homepage.owner")</h3>
                            <p>@lang("homepage.subowner")</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="feature">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 wow fadeInRight" data-wow-delay=".8s">
                    <h2 class="title">@lang("homepage.why")</h2>

                    <div class="feature-item">

                        <div class="media">
                            <div class="pull-left icon" href="#">
                                <i class="fa fa-heart"></i>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">@lang("homepage.save")</h4>
                                <p>@lang("homepage.subsave")</p>
                            </div>
                        </div>
                    </div>

                    <div class="feature-item">

                        <div class="media">
                            <div class="pull-left icon" href="#">
                                <i class="fa fa-usd"></i>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">@lang("homepage.cost")</h4>
                                <p>@lang("homepage.subcost")</p>
                            </div>
                        </div>
                    </div>

                    <div class="feature-item">

                        <div class="media">
                            <div class="pull-left icon" href="#">
                                <i class="fa fa-rocket"></i>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">@lang("homepage.hero")</h4>
                                <p>@lang("homepage.subhero")</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 wow fadeInLeft" data-wow-delay=".8s">
                    <div class="block">
                        <img class="img-responsive" src="images/featured-app.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="utility">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 wow fadeInUp" data-wow-delay=".8s">
                    <img class="img-responsive" src="images/mockup.png" alt="">
                </div>
                <div class="col-md-6 col-sm-6 wow fadeInDown" data-wow-delay=".8s">
                    <div class="block">
                        <h2>@lang("homepage.mission")</h2>
                        <p>
                            @lang("homepage.submission")
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="utility-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 wow fadeInLeft" data-wow-delay=".8s">
                    <div class="block">
                        <h2>@lang("homepage.vision")</h2>
                        <p>
                          @lang("homepage.subvision")
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 wow fadeInRight" data-wow-delay=".8s">
                    <img class="img-responsive" src="images/app-screen.png" alt="">
                </div>
            </div>
        </div>
    </section>


    <section id="subscribe" >
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInDown" data-wow-delay=".8s">
                    <div class="block">
                        <div class="title text-center">
                            <h2>@lang("homepage.interested")</h2>
                            <a href="{{ url("register") }}"><button class="btn btn-success btn-lg">@lang("homepage.bottom_join")</button></a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@stop
