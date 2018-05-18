@extends("layout.index")

@section("content")
@include("layout.menu.main")
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
            <label for="uname">Username</label>
            <input type="text" name="uname" class="form-control" id="uname" placeholder="username" />
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
