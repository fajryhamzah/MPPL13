<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="{{ asset("js/pusher.js") }}"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('16226bb2107d23c5f075', {
      cluster: 'ap1',
      encrypted: true
    });

    var channel = pusher.subscribe('private-notif');
    channel.bind('testing', function(data) {
      console.log(data);
      alert(data.message);
    });
  </script>
</head>
