<header>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-6 col-sm-3">
                <a href="{{ url("") }}" class="logo">
                    <img src="{{ asset("images/logo.png") }}" alt="" style="width:60%;">
                </a>
            </div>
            <div class="col-md-9 col-sm-push-2">
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
                                    <li><a href="{{ url("dashboard") }}">Dashboard</a></li>
                                    <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Adoption <span class="caret"></span></a>
                                      <ul class="dropdown-menu">
                                        <!-- <li role="separator" class="divider"></li> -->
                                        <li>
                                          <a href="{{ url("open") }}">Open adoption</a>
                                        </li>
                                      </ul>
                                    </li>
                                    <li><a href="#">Message</a></li>
                                    <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile <span class="caret"></span></a>
                                      <ul class="dropdown-menu">
                                        <!-- <li role="separator" class="divider"></li> -->
                                        <li>
                                          <a href="{{ url("logout") }}">Log out</a>
                                        </li>
                                      </ul>
                                    </li>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
