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
          <div id="msg">

          </div>
          <button type="submit" id="log">@lang("login.button")</button>
        </form>

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
