<footer>
  <div class="row" style="margin-bottom:0">
    <div class="col s12">
      © Copyright 2018 <b>Adopet</b>. All right reserved.
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
