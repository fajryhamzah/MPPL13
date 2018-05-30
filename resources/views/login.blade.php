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
              <span class="card-title">@lang("login.sign_in")</span>
              <p>@lang("login.sub_sign_in")</p>

              <form name="login" method="post" id="login">

                <div class ="row">
                  <div class="input-field col s12">
                    <input type="text" name="uname" class="form-control" id="email" aria-describedby="emailH" required/>
                    <label for="email" class="lbl">Username/Email</label>
                    <span class="helper-text" style="color:rgb(244, 67, 54);display:none"></span>
                  </div>
                  <div class="input-field col s12">
                    <input type="password" name="pass" class="form-control" id="emai" required/>
                    <label for="emai" class="lbl">Password</label>
                  </div>
                </div>

                {{ csrf_field() }}
                <div class ="row">
                  <div class="col s12">
                    <button type="submit" class="btn" id="log">@lang("login.button")</button>
                  </div>
                </div>
              </form>
              <div class ="row center-align" style="margin-bottom:0;">
                <div class="col s12">
                    <span>@lang("login.sign_up")</span>
                </div>
              </div>


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

              if(ret["code"] == 403){
                $(".lbl").addClass("active");
                $(".form-control").addClass("invalid");
                $(".helper-text").html("@lang("login.error_active")");
                $(".helper-text").show();
              }
              else{
                $(".lbl").addClass("active");
                $(".form-control").addClass("invalid");
                $(".helper-text").html("@lang("login.error")");
                $(".helper-text").show();
              }

            }
            else{
              window.location = "{{  url("dashboard") }}";
            }
        }});
      });

    })
  </script>
@stop
