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
              <span class="card-title">@lang("register.sign_up")</span>
              <p>@lang("register.sub_sign_up")</p>

              <form name="regist" method="post" id="regist">

                <div class ="row">
                  <div class="input-field col s12">
                    @if( ((\Session::get("error") ) && ( \Session::get("error")->has("email") )) || ( \Session::get("msg")["email"] ) )
                      <input type="email" name="email" class="form-control invalid" id="email" aria-describedby="emailH" required/>
                      <label for="email" class="active">Email</label>
                      <span class="helper-text" style="color:rgb(244, 67, 54)">{{ (\Session::get("error")) ? \Session::get("error")->get("email")[0] : \Session::get("msg")["email"]}}</span>
                    @else
                      <input type="email" name="email" class="form-control" id="email" aria-describedby="emailH" required/>
                      <label for="email">Email</label>
                    @endif

                  </div>
                  <div class="input-field col s12">
                    @if( ((\Session::get("error") ) && ( \Session::get("error")->has("uname") )) || ( \Session::get("msg")["uname"] ) )
                      <input type="text" name="uname" class="form-control invalid" id="uname" required/>
                      <label for="uname" class="active">Username</label>
                      <span class="helper-text" style="color:rgb(244, 67, 54)">{{(\Session::get("error")) ? \Session::get("error")->get("uname")[0] : \Session::get("msg")["uname"]}}</span>
                    @else
                      <input type="text" name="uname" class="form-control" id="uname" required/>
                      <label for="uname">Username</label>
                    @endif
                  </div>
                  <div class="input-field col s12">
                    @if( (\Session::get("error") ) && ( \Session::get("error")->has("pass") ) )
                      <input type="password" name="pass" class="form-control invalid" id="pass" required/>
                      <label for="pass" class="active">Password</label>
                      <span class="helper-text" style="color:rgb(244, 67, 54)">{{\Session::get("error")->get("pass")[0]}}</span>
                    @else
                      <input type="password" name="pass" class="form-control" id="pass" required/>
                      <label for="pass">Password</label>
                    @endif

                  </div>
                </div>
                {{ csrf_field() }}
                <div class ="row">
                  <div class="col s12">
                    <button type="submit" class="btn btn-primary" id="log">@lang("register.sign_up")</button>
                  </div>
                </div>
              </form>

              <div class ="row center-align" style="margin-bottom:0;">
                <div class="col s12">
                    <span>@lang("register.sign_in")</span>
                </div>
              </div>

            </div>
          </div>
        </div>

    </div>
  </div>
</section>
@stop
