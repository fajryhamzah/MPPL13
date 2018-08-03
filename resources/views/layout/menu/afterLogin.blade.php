<header>
  <!-- Dropdown Structure -->
  <ul id="dropdown1" class="dropdown-content">
    <li><a href="{{ url("profile") }}">@lang("menu.profile")</a></li>
    <li><a href="{{ url("setting/profile") }}">@lang("menu.setting")</a></li>
    <li class="divider"></li>
    <li><a href="{{ url("logout") }}">@lang("menu.logout")</a></li>
  </ul>

  <!-- Dropdown Structure -->
  <ul id="dropdown3" class="dropdown-content">
    <div id="menu-notif">

    </div>
    <!-- <li><a href="{{ url("finder") }}">Read More</a></li> -->
  </ul>
  <nav>
    <div class="nav-wrapper">
      <a href="{{ url("") }}" class="brand-logo">
          <img src="{{ asset("images/logo1.png") }}" alt="" style="width:60%;">
      </a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a class="dropdown-trigger notif" href="#!" data-target="dropdown3">@lang("menu.notif") <span class="badge light-blue darken-2 white-text" id="notif-no" style="display:none"></span></a></li>
        <li><a href="{{ url("dashboard") }}">@lang("menu.dashboard")</a></li>
        <li><a href="{{ url("finder") }}">@lang("menu.find")</a></li>
        <li><a href="{{ url("open") }}">@lang("menu.post")</a></li>
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><img src="{{ asset("img/avatar/") }}/{{ (\Session::get("img_profile"))? \Session::get("img_profile"): "default.png" }}" id="profile-icon" /></a></li>
      </ul>
    </div>
  </nav>
</header>
