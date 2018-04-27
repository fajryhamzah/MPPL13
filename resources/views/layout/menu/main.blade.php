<header>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-6 col-sm-3">
                <a href="{{ url("") }}" class="logo">
                    <img src="{{ asset("images/logo.png") }}" alt="" style="width:60%;">
                </a>
            </div>
            <div class="col-md-6 col-xs-6 col-sm-6">
                <div class="menu">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li><a href="{{ url("/#banner") }}">Home</a></li>
                                    <li><a href="{{ url("/#service") }}">Service</a></li>
                                    <li><a href="{{ url("/#feature") }}">Feature</a></li>
                                    <li><a href="{{ url("/#utility") }}">Utility</a></li>
                                    <li><a href="{{ url("/#subscribe") }}">Subscribe</a></li>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-3">
                <ul class="social-info">
                    <li><a href="{{ url("login") }}">Login</a></li>
                    <li><a href="{{ url("register") }}">Register</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
