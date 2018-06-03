<header>
  <!-- Dropdown Structure -->
  <ul id="dropdown1" class="dropdown-content">
    <li><a href="{{ url("profile") }}">Profile</a></li>
    <li><a href="{{ url("setting/profile") }}">Setting</a></li>
    <li class="divider"></li>
    <li><a href="{{ url("logout") }}">Logout</a></li>
  </ul>
  <!-- Dropdown Structure -->
  <ul id="dropdown2" class="dropdown-content">
    <li><a href="{{ url("open") }}">My Post</a></li>
    <li><a href="{{ url("finder") }}">Adoption Info</a></li>
  </ul>
  <nav>
    <div class="nav-wrapper">
      <a href="{{ url("") }}" class="brand-logo">
          <img src="{{ asset("images/logo1.png") }}" alt="" style="width:60%;">
      </a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="{{ url("dashboard") }}">Dashboard</a></li>
        <li><a href="{{ url("finder") }}">Find Pet</a></li>
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">Adoption<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><img src="{{ asset("img/avatar/") }}/{{ (\Session::get("img_profile"))? \Session::get("img_profile"): "default.png" }}" id="profile-icon" /></a></li>
      </ul>
    </div>
  </nav>
</header>
