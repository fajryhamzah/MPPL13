@extends("layout.index")

@section("content")
@if(\Session::has("id"))
  @include("layout.menu.afterLogin")
@else
  @include("layout.menu.home")
@endif

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
                            Adopt, Don’t Shop!
                        </h1>
                        <p>
                            Adopet is a website where shelters and rescues list their pets for adoption.
                        </p>

                        <ul class="download-btn">
                            <li>
                                <a href="{{ url("register") }}" class="btn btn-default btn-andriod">Join Us Now</a>
                            </li>
                            <li>
                                <a href="{{ url("login") }}" class="btn btn-default btn-windows">Already have an account</a>
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

                            <h3>Find your new buddy</h3>
                            <p>You can find a pet with your own preferences very easy.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="block wow fadeInRight" data-wow-delay="1.3s">
                            <div class="icon">
                                <i class="fa fa-home"></i>
                            </div>
                            <h3>Choose new owner</h3>
                            <p>You can give your beloved pet to the right people.</p>
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
                    <h2 class="title">Why adopt?</h2>

                    <div class="feature-item">

                        <div class="media">
                            <div class="pull-left icon" href="#">
                                <i class="fa fa-heart"></i>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Save a life</h4>
                                <p>To judge our effectiveness by the extent to which animal lives are saved and improved, and by the positive experience of the people we touch</p>
                            </div>
                        </div>
                    </div>

                    <div class="feature-item">

                        <div class="media">
                            <div class="pull-left icon" href="#">
                                <i class="fa fa-usd"></i>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">It’ll cost less</h4>
                                <p>You don't need a lot of money to have a pet.</p>
                            </div>
                        </div>
                    </div>

                    <div class="feature-item">

                        <div class="media">
                            <div class="pull-left icon" href="#">
                                <i class="fa fa-rocket"></i>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">BE A HERO!</h4>
                                <p>be a hero to protect animals. we believe, we can save them</p>
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
                        <h2>Our Mission</h2>
                        <p>
                            We want all pet have someone that loved them, provide them warm place and something to eat so they can happily live.
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
                        <h2>Our Vision</h2>
                        <p>
                          We want to be the leading authority in animal care and protection.
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
                            <h2>Interested?</h2>
                            <a href="{{ url("register") }}"><button class="btn btn-success btn-lg">Join Us</button></a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@stop
