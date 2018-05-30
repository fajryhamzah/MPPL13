<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        @yield("meta")
        <title>Adopet</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <!-- CSS -->
        <link rel="stylesheet" href="{{asset("css/materialize.min.css")}}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{asset("css/main.css")}}">
        <link rel="stylesheet" href="{{asset("css/animate.css")}}">


        <!-- Js -->
        <script src="{{asset("js/vendor/jquery-1.10.2.min.js")}}"></script>
        <script src="{{asset("js/materialize.min.js")}}"></script>
        <script src="{{asset("js/wow.min.js")}}"></script>
        <script>
         new WOW().init();
        </script>
        @yield("top_include")
    </head>
    <body>
