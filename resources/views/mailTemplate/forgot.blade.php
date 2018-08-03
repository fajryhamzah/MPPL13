<html>
<head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');
     *{
       font-family: 'Roboto', sans-serif;
     }
</style>

</head>
<body style="padding:0;margin:0">
    <div style="background-color:#00BDE3;padding:10px;">
      <img src="{{ asset("images/logo.png") }}" alt="" style="width:200px;">
    </div>
    <table style="min-height:300px;margin:0 auto">
      <tr>
        <td style="max-width:400px">
          <span style="font-size:25px;display:block;magin-bottom:10px">@lang("mail.hi_forgot",["name" => (isset($name)) ? $name : $username])</span><br>
          <span style="display:block;margin-bottom:10px">@lang("mail.forgot")</span><br />


          <a style="padding:10px;background:#00BDE3;color:white;text-decoration:none" href="{{ url('/forgot') }}/{{ $id }}">@lang("mail.forgot_button")</a>

        </td>
        <td style="background:url('{{ asset("images/forgot.jpg") }}');background-repeat:no-repeat;background-size:250px 180px;   width: 250px; height: 180px;">
        </td>
      </tr>
    </table>
    <div style="text-align:center;color:#B6B6B6">
      Adopet System
    </div>
</body>
</html>
