<footer>
  <div class="row" style="margin-bottom:0">
    <div class="col s12">
      <div class="col s6">
        © Copyright 2018 <b>Adopet</b>. All right reserved.
      </div>
      <div class="col s6 right-align">
        <a class="white-text" href="{{ url("lang/en/back/")."/".base64_encode(request()->fullUrl()) }}">English</a>
         |
        <a class="white-text" href="{{ url("lang/id/back/")."/".base64_encode(request()->fullUrl()) }}">Indonesia</a>
      </div>
    </div>
  </div>
</footer>
@yield("bottom_include")
  <script type="text/javascript">
      $(document).ready(function(){
          var n = $(".dropdown-trigger").dropdown({ constrainWidth: false });

          $.ajax({
            url: "{{url("api/notification")}}",
            dataType: "json",
            success: function(data){
              notificationAdd(data,true);
            }
          });

          $(".notif").on("click",function(){
            var instance = M.Dropdown.getInstance(n);
            if(instance.isOpen){

              $.ajax({
                type: "POST",
                url: "{{ url("api/seen") }}",
                data: {ids:notif_id},
                success: function(result){
                  if(result == 200){
                    $("#notif-no").html("0").hide();
                    notif_id = [];
                  }

                },
              });
            }
          });
          @yield("jquery")
      })
  </script>
  </body>
  </html>
