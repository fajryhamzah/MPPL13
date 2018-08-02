@extends("layout.index")

@section("content")
@include("layout.menu.main")
<section id="log_in">
  <div class="row">

    <div class="col s12">
        <div class="col s4" style="float:none;margin:0 auto;">
          <div class="card" style="padding:5%;margin-top:20%">
            <div class="card-content black-text">
              <img src="{{ asset("images/logo2.png")}}" />
              <span class="card-title">@lang("forgot.change")</span>

              <form name="login" method="post">

                <div class ="row">
                  <div class="input-field col s12">
                    <input type="password" name="pass" class="form-control" id="email" aria-describedby="emailH" required/>
                    <label for="email" class="lbl">@lang("forgot.change_pass")</label>
                  </div>
                  <div class="input-field col s12">
                    <input type="password" name="confirmpass" class="form-control" id="emai" required/>
                    <label for="emai" class="lbl">@lang("forgot.change_conf")</label>
                  </div>
                </div>
                <span class="helper-text" style="color:rgb(244, 67, 54);">{!! \Session::get("error") !!}</span>
                
                {{ csrf_field() }}
                <div class ="row">
                  <div class="col s12">
                    <button type="submit" class="btn" id="log">@lang("forgot.change_button")</button>
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
