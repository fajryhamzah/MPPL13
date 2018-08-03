<header>
  <div class="row">
    <div class="col s12" style="padding:0px">
        <nav>
           <div class="nav-wrapper">
             <img src="{{ asset("images/logo.png")}}" id="logo" />
             <ul id="nav-mobile" class="right hide-on-med-and-down">
               <li><a href="#banner">@lang("menu.home")</a></li>
               <li><a href="#why">@lang("menu.about")</a></li>
               <li><a href="#features">@lang("menu.features")</a></li>
               <li><a href="#vision">@lang("menu.vision")</a></li>
               <li><a class="btn nav-button" href="{{ url("login") }}">@lang("menu.login")</a></li>
               <li><a class="btn nav-button" href="{{ url("register") }}">@lang("menu.register")</a></li>
             </ul>
           </div>
         </nav>
    </div>
  </div>
</header>
