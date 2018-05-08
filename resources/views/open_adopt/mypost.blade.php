@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")
<section>
  <div class="container">
    <div class="row">
      <span>{{\Session::get("error")}}</span>
      <div class="col-md-12" style="padding:12px">
        <a href="{{ url("open_adopt") }}"><button type="button" class="btn btn-success btn-lg"><i class="fa fa-plus-square"></i> Add New Adoption</button></a>
      </div>

      <div class="row">
        @foreach($own as $a)
          <div class="col m4">
            <div class="card">
              <div class="card-content">
                <span class="card-title">{{$a->title}}</span>
                <p>{{ $a->post_date }} {{ $a->pet }} {{ ($a->status == 1)? "Open":"Closed" }}</p>
              </div>
              <div class="card-action">
                <a href="{{ url("open_adopt/edit/".$a->id) }}" class="btn btn-primary" role="button">Edit</a>
                <a href="{{ url("open_adopt/delete/".$a->id) }}" class="btn btn-danger" role="button">Delete</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>


    </div>
  </div>
</section>
@stop
