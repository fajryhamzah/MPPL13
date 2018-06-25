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

          var pusher = new Pusher('16226bb2107d23c5f075', {
            cluster: 'ap1',
          });

          var channel = pusher.subscribe('notif-{{ \Session::get("channel")}}');
          channel.bind('notification', function(data) {
            //increment badge
            var i = parseInt(document.getElementById("notif-no").innerHTML);
            if(isNaN(i)){
              i = 0;
            }

            document.getElementById("notif-no").innerHTML = i+1;

            console.log(data);
          });
        </script>
        @yield("top_include")
    </head>
    <body>
