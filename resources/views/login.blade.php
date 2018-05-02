@extends("layout.index")

@section("content")
@include("layout.menu.main")
<section class="sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <form name="login" method="post" id="login">
          <div class="form-group">
            <label for="email">Username/Email</label>
            <input type="text" name="uname" class="form-control" id="email" aria-describedby="emailH" placeholder="Username or email"/>
            <small id="emailH" class="form-text text-muted">@lang("login.info")</small>
          </div>
          <div class="form-group">
            <label for="emai">Password</label>
            <input type="password" name="pass" class="form-control" id="emai" placeholder="Password"/>
          </div>
          {{ csrf_field() }}
          <button type="submit" id="log">@lang("login.button")</button>
        </form>
        <div id="msg">

        </div>
      </div>
    </div>
  </div>
</section>
{{\Session::get("error")}}
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
            if(ret["code"] == 403){
              $("#msg").html(ret["msg"]);
            }
            else{
              window.location = "{{  url("dashboard") }}";
            }
        }});
      });

    })
  </script>
@stop
