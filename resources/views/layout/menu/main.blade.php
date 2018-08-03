<header>
  <div class="row" style="margin-bottom:0px;">
    <div class="col s12" style="padding:0px">
        <nav id="nav-main">
           <div class="nav-wrapper">
             <img src="{{ asset("images/logo1.png")}}" id="logo" />
             <ul id="nav-mobile" class="right hide-on-med-and-down">
               <li><a href="{{ url("/#banner")}}">@lang("menu.home")</a></li>
               <li><a href="{{ url("/#why")}}">@lang("menu.about")</a></li>
               <li><a href="{{ url("/#features")}}">@lang("menu.features")</a></li>
               <li><a href="{{ url("/#vision")}}">@lang("menu.vision")</a></li>
               <li><a class="btn nav-button" href="{{ url("login") }}">@lang("menu.login")</a></li>
               <li><a class="btn nav-button" href="{{ url("register") }}">@lang("menu.register")</a></li>
             </ul>
           </div>
         </nav>
    </div>
  </div>
</header>
