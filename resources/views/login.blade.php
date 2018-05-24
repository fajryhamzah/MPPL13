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
              <span class="card-title">@lang("login.sign_in")</span>
              <p>@lang("login.sub_sign_in")</p>

              <form name="login" method="post" id="login">

                <div class ="row">
                  <div class="input-field col s12">
                    <input type="text" name="uname" class="form-control" id="email" aria-describedby="emailH" placeholder="Username or email"/>
                    <label for="email">Username/Email</label>
                  </div>
                </div>

                <div class ="row">
                  <div class="input-field col s12">
                    <input type="password" name="pass" class="form-control" id="emai" placeholder="Password"/>
                    <label for="emai">Password</label>
                  </div>
                </div>

                {{ csrf_field() }}
                <div id="msg">

                </div>
                <div class ="row">
                  <div class="col s12">
                    <button type="submit" class="btn" id="log">@lang("login.button")</button>
                  </div>
                </div>
              </form>

              <span>@lang("login.sign_up")</span>
            </div>
          </div>
        </div>

    </div>
  </div>
</section>
@stop
@section("bottom_include")
  <script type="text/javascript">
    $(document).ready(function(){
      $("#login").submit(function(e){
        return false;
      });

      $("#log").on("click",function(e){
        e.preventDefault();
        var data = $("#login").serialize();
        $.ajax({
          url: "{{url('/login')}}",
          type: "post",
          data: data,
          success: function(result){
            var ret = $.parseJSON(result);
            if(ret["code"] != 200){
              var val = ret["msg"];

              if(val.constructor === Array){
                val = '<div class="alert alert-danger" role="alert">'+val.join("<br>")+'</div>';
              }
              else{
                val = '<div class="alert alert-danger" role="alert">'+val+'</div>';
              }
              $("#msg").html(val);
            }
            else{
              window.location = "{{  url("dashboard") }}";
            }
        }});
      });

    })
  </script>
@stop
