<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        @yield("meta")
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <!-- CSS -->
        <link rel="stylesheet" href="{{asset("css/materialize.min.css")}}">
        <link rel="stylesheet" href="{{asset("css/main_dashboard.css")}}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        @yield("css")
        <!--<link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}"> -->

        <!-- Js -->
        <script src="{{asset("js/vendor/jquery-1.10.2.min.js")}}"></script>
        <script src="{{asset("js/materialize.min.js")}}"></script>
        <script src="{{ asset("js/pusher.js") }}"></script>
        <script>

        function notificationAdd(data,fromDB = false){
          var i = parseInt(document.getElementById("notif-no").innerHTML);
          if(isNaN(i)){
            i = 0;
          }

          var msg;
          var li = document.createElement("li");
          var txt;
          if(fromDB){
            document.getElementById("notif-no").innerHTML = i+data.count;

            data.data.forEach(function(msg){
              console.log(msg)
              if(msg.type == "new_bidder"){
                  txt = "@lang("notification.new_adopter")".replace(":name",msg.name);
                  li.innerHTML = "<a href='{{ url("post") }}/"+msg.id_post+"'>"+txt+"</a><span>"+msg.date+"</span>";
              }
              else{
                  li.innerHTML = "<a href='{{ url("post") }}/"+msg.id_post+"'>Read More</a>";
              }
            });

          }
          else{
            document.getElementById("notif-no").innerHTML = i+1;
            msg = data;

            if(msg.type == "new_bidder"){
                txt = "@lang("notification.new_adopter")".replace(":name",msg.name);
                li.innerHTML = "<a href='{{ url("post") }}/"+msg.id_post+"'>"+txt+"</a><span>"+msg.date+"</span>";
            }
            else{
                li.innerHTML = "<a href='{{ url("post") }}/"+msg.id_post+"'>Read More</a>";
            }

          }





          document.getElementById("menu-notif").appendChild(li);
        }

          var pusher = new Pusher('16226bb2107d23c5f075', {
            cluster: 'ap1',
          });

          var channel = pusher.subscribe('notif-{{ \Session::get("channel")}}');
          channel.bind('notification', function(data) {
            notificationAdd(data.message);
            console.log(data);
          });


        </script>
        @yield("top_include")
    </head>
    <body>
