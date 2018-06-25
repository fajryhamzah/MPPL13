<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="{{ asset("js/pusher.js") }}"></script>
  <script>

    var pusher = new Pusher('16226bb2107d23c5f075', {
      cluster: 'ap1',
    });

    var channel = pusher.subscribe('notif-{{ \Session::get("channel")}}');
    channel.bind('notification', function(data) {
      console.log(data);
      alert(data.message);
    });
  </script>
</head>
