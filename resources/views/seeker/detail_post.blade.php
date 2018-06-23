@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")
<div class="row">
  <div class="col s12">
    {{\Session::get("error")}}
    @if(isset($bidder_count))
      You're the owner here the Count: {{ $bidder_count }}
    @else
    <form name="apply" method="post">
      {{ csrf_field() }}

      @if(isset($bidder_post))
        you're already apply
        msg:
        <textarea name='msg'>{{ $bidder_post->message  }}</textarea>
      @else
        <textarea name='msg'></textarea>
      @endif
    @endif
    <button>Submit</button>
    </form>

  </div>
</div>


@stop
