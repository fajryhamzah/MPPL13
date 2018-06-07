<ul>
@foreach($data as $d)
<li>{{$d->title}}
  {{$d->post_date}}
  {{$d->distance}}KM 
</li>
@endforeach
</ul>
