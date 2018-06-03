@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")
  <section>
    <div style="margin-top:2%;">
      <div class="row">
        <div class="col s12">
            @include("profile.side")

            <div class="col s7 content">
              <form name="editProf" method="post">
                  {{ \Session::get("success")}}
                  <div class ="row">
                    <div class="input-field col s7">
                      @if((\Session::has("wrong")) || (\Session::has("error")) )
                        <input id="first_name2" type="password" class="validate invalid" name="oldpass">
                        <span class="helper-text" style="color:rgb(244, 67, 54)">{{ (\Session::get("wrong"))? \Session::get("wrong") : \Session::get("error")->first("oldpass") }}</span>
                      @else
                          <input id="first_name2" type="password" class="validate invalid" name="oldpass" value="{{ old("oldpass") }}">
                      @endif
                      <label class="active" for="first_name2">@lang("profile/change_pass.oldpass")</label>
                    </div>

                      @if((\Session::has("different")) || (\Session::has("error")) )
                        <div class="input-field col s7">
                          <input id="name" type="password" class="validate invalid" name="newpass" value="{{ old("newpass") }}">
                          <label class="active" for="name">@lang("profile/change_pass.newpass")</label>
                          <span class="helper-text" style="color:rgb(244, 67, 54)">{{ (\Session::get("different"))? \Session::get("different") : \Session::get("error")->first("newpass") }}</span>
                        </div>
                        <div class="input-field col s7">
                          <input id="name1" type="password" class="validate invalid" name="confirmnewpass" value="{{ old("confirmnewpass") }}">
                          <label class="active" for="name1">@lang("profile/change_pass.confirmnewpass")</label>
                          @if( (\Session::has("error")) && (\Session::get("error")->has("confirmnewpass")) )
                            <span class="helper-text" style="color:rgb(244, 67, 54)">{{ \Session::get("error")->first("confirmnewpass") }}</span>
                          @endif
                        </div>
                      @else
                        <div class="input-field col s7">
                          <input id="name" type="password" class="validate" name="newpass" value="{{ old("newpass") }}">
                          <label class="active" for="name">@lang("profile/change_pass.newpass")</label>
                        </div>
                        <div class="input-field col s7">
                          <input id="name1" type="password" class="validate" name="confirmnewpass" value="{{ old("confirmnewpass") }}">
                          <label class="active" for="name1">@lang("profile/change_pass.confirmnewpass")</label>
                        </div>
                      @endif

                  </div>

                  <div class="row">
                    <div class="input-field col s6">
                      <button type="submit" class="btn btn-primary">@lang("profile/change_pass.submit")</button>
                    </div>
                  </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
@stop
