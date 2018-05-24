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
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailH" />
                    <label for="email">Email</label>
                  </div>
                  <div class="input-field col s12">
                    <input type="text" name="uname" class="form-control" id="uname" />
                    <label for="uname">Username</label>
                  </div>
                  <div class="input-field col s12">
                    <input type="password" name="pass" class="form-control" id="pass" />
                    <label for="pass">Password</label>
                  </div>
                </div>

                {{ csrf_field() }}
                <div id="msg">
                  @if(\Session::get("error"))
                     @if(is_array(\Session::get("error")))
                       <div class="alert alert-danger" role="alert">
                         <ul>
                         @foreach(\Session::get("error") as $a)
                           <li>{{$a}}</li>
                         @endforeach
                         </ul>
                       </div>
                     @else
                       <div class="alert alert-danger" role="alert">
                         {{\Session::get("error")}}
                       </div>
                     @endif

                  @endif


                </div>
                <div class ="row">
                  <div class="col s12">
                    <button type="submit" class="btn btn-primary" id="log">Register</button>
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
