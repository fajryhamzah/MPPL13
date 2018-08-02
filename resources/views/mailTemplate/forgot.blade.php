Hi, {{$name or $username}}<br>
Follow this link to change your password
<br>
Check this <a href="{{ url('/forgot') }}/{{ $id }}">Link</a>
