<div class="col s3" style="padding-right:0px;">
  <ul class="setting-nav">
    <li {!! ($page == "general")? "class='active'":'' !!}><a href="{{ url("setting/profile") }}">@lang("profile/side.profile")</a></li>
    <li {!! ($page == "change")? "class='active'":'' !!}><a href="{{ url("setting/change_password")}}">@lang("profile/side.change")</a></li>
    <li {!! ($page == "email")? "class='active'":'' !!}><a href="{{ url("setting/notification")}}">@lang("profile/side.notification")</a></li>
  </ul>
</div>
