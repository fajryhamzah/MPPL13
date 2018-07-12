@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")
  <section>
    <div style="margin-top:2%;">
      <div class="row">
        <div class="col s12">
            @include("profile.side")

            <div class="col s7 content">
              <div class="col s12 offset-s2">
              <h3>@lang("profile/notif.title")</h3>
              <form name="editProf" method="post">
                  {{ \Session::get("error")}}
                  {{ \Session::get("success")}}
                  <div class ="row">
                    <div class="input-field col s7">
                      <p>
                        <label>
                          <input type="checkbox" class="filled-in" name="bidder" {{ ($notif_new_bidder == 1)? "checked='checked'":"" }} />
                          <span>@lang("profile/notif.new_bidder")</span>
                        </label>
                      </p>
                      <p>
                        <label>
                          <input type="checkbox" class="filled-in" name="choosen" {{ ($notif_choosen == 1)? "checked='checked'":"" }} />
                          <span>@lang("profile/notif.choosen")</span>
                        </label>
                      </p>
                      <p>
                        <label>
                          <input type="checkbox" class="filled-in" name="post" {{ ($notif_new_post == 1)? "checked='checked'":"" }} />
                          <span>@lang("profile/notif.new_post")</span>
                        </label>
                      </p>
                      {{ csrf_field() }}

                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s6">
                      <button type="submit" class="btn btn-primary">@lang("profile/notif.submit")</button>
                    </div>
                  </div>
              </form>
            </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
@stop
