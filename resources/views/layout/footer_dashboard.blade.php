@yield("bottom_include")
<script type="text/javascript">
    $(document).ready(function(){
        $(".dropdown-trigger").dropdown();
        @yield("jquery")
    })
</script>
</body>
</html>
