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
              <span class="card-title">@lang("forgot.header")</span>
              <p>@lang("forgot.sub_header")</p>

              <form  method="post" id="login">

                <div class ="row">
                  <div class="input-field col s12">
                    <input type="text" name="uname" class="form-control" id="email" aria-describedby="emailH" required/>
                    <label for="email" class="lbl">Username/Email</label>
                    <span class="helper-text" style="color:rgb(244, 67, 54);display:none"></span>
                    <span class="helper-text succ" style="color:#66bb6a;display:none"></span>
                    <span class="load" style="display:none">Loading....</span>
                  </div>

                {{ csrf_field() }}
                <div class ="row">
                  <div class="col s12">
                    <button type="submit" class="btn" id="log">@lang("forgot.button")</button>
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
@section("bottom_include")
  <script type="text/javascript">
    $(document).ready(function(){
      $("#login").submit(function(e){
        return false;
      });

      $("#log").on("click",function(e){
        e.preventDefault();
        var data = $("#login").serialize();
        $(".load").show();
        $.ajax({
          url: "{{url('/forgot')}}",
          type: "post",
          data: data,
          success: function(result){
            var ret = result;
            if(ret != 200){

              if(ret == 403){
                $(".helper-text").html("@lang("forgot.error_active")");
              }
              else{
                $(".helper-text").html("@lang("forgot.error")");
              }

              $(".form-control").addClass("invalid");
              $(".helper-text").show();

            }
            else{
              $(".succ").html("@lang("forgot.success")");
              $(".succ").show();
            }
            $(".load").hide();
        }});

      });

    })
  </script>
@stop
