@extends("layout.index")
@section("content")
@include("layout.menu.afterLogin")
<section class="sec">
  <div class="container">
    <div class="row">
      <span>{{\Session::get("error")}}</span>
      <div class="col-md-12" style="padding:12px">
        <a href="{{ url("open_adopt") }}"><button type="button" class="btn btn-success btn-lg"><i class="fa fa-plus-square"></i> Add New Adoption</button></a>
      </div>

      @foreach($own as $a)
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <div class="caption">
              <h3>{{$a->title}}</h3>
              <span>{{ $a->post_date }}</span> |
              <span>{{ $a->pet }}</span> |
              <span>{{ ($a->status == 1)? "Open":"Closed" }}</span>
              <p>
                <a href="{{ url("open_adopt/edit/".$a->id) }}" class="btn btn-primary" role="button">Edit</a>
                <a href="{{ url("open_adopt/delete/".$a->id) }}" class="btn btn-danger" role="button">Delete</a>
              </p>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>
</section>
@stop
