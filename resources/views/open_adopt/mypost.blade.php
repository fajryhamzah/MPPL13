@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")
<section>
  <div class="row">
    <div class="col s12">
      @include("open_adopt.side")
      <div class="col s7 content">
        <div class="col s12 offset-s2">
          <div class="col s12">
            <div class="col s6">
              <h4>@lang("open_post/post.header")</h4>
            </div>
            <div class="col s6 right-align head-link">
              <a href="{{ url("open_adopt") }}">  <i class="small material-icons">add</i> @lang("open_post/post.header_create")</a>
              <a href="#" style="color:rgb(228, 0, 27)"> <i class="small material-icons">delete</i> @lang("open_post/post.header_delete")</a>
            </div>
          </div>

          
        </div>
      </div>
    </div>
  </div>

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
