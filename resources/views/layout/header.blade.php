<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        @yield("meta")
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <!-- CSS -->
        <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
        <link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}">
        <link rel="stylesheet" href="{{asset("css/main.css")}}">
        <link rel="stylesheet" href="{{asset("css/animate.css")}}">
        <link rel="stylesheet" href="{{asset("css/responsive.css")}}">


        <!-- Js -->
        <script src="{{asset("js/vendor/modernizr-2.6.2.min.js")}}"></script>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
        <script src="{{asset("js/vendor/jquery-1.10.2.min.js")}}"></script>
        <script src="{{asset("js/bootstrap.min.js")}}"></script>
        <script src="{{asset("js/plugins.js")}}"></script>
        <script src="{{asset("js/main.js")}}"></script>
        <script src="{{asset("js/wow.min.js")}}"></script>
        <script>
         new WOW(
            ).init();
        </script>
        @yield("top_include")
    </head>
    <body>
