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
        $(".dropdown-trigger").dropdown();
        @yield("jquery")
    })
</script>
</body>
</html>
