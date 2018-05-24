@extends("layout.index")

@section("content")
@include("layout.menu.main")
<section id="log_in">
  <div class="row">

    <div class="col s12">
        <div class="col s6" style="float:none;margin:0 auto;">
          <div class="card" style="padding:5%;margin-top:20%">
            <div class="card-content black-text">
              <img src="{{ asset("images/logo2.png")}}" />
              <span class="card-title">@lang("register.sign_up")</span>
              <p>@lang("register.sub_sign_up")</p>

              <form name="regist" method="post">

                <div class ="row">
                  <div class="input-field col s12">
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailH" placeholder="your_email@your_email.com"/>
                    <label for="email">Email</label>
                  </div>
                </div>

                <div class ="row">
                  <div class="input-field col s12">
                    <input type="text" name="uname" class="form-control" id="uname" placeholder="username" />
                    <label for="uname">Username</label>
                  </div>
                </div>

                <div class ="row">
                  <div class="input-field col s12">
                    <input type="password" name="pass" class="form-control" id="pass" placeholder="@lang("register.strong")" />
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
                    <button type="submit" class="btn btn-primary">Register</button>
                  </div>
                </div>
              </form>

              <span>@lang("register.sign_in")</span>
            </div>
          </div>
        </div>

    </div>
  </div>
</section>
<section class="sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <form name="regist" method="post">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailH" placeholder="your_email@your_email.com"/>
            <small id="emailH" class="form-text text-muted">We use this for verification and notification.</small>
          </div>
          <div class="form-group">

          </div>
          <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" name="pass" class="form-control" id="pass" placeholder="make a strong password" />
          </div>
         {{ csrf_field() }}

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

         <button type="submit" class="btn btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>
</section>

@stop
