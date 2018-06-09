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
              <a href="#" id="bulk_delete" style="color:rgb(228, 0, 27)"> <i class="small material-icons">delete</i> @lang("open_post/post.header_delete")</a>
            </div>
          </div>

          <div class="col s12">
            <form name="bulk" method="post" id="massDelete">
              <table class="table table-bordered" id="table">
                  <thead>
                      <tr>
                          <th class="no-sort"><label><input type="checkbox" class="parent_delete_ids" /><span></span></label></th>
                          <th>@lang("open_post/post.name")</th>
                          <th>@lang("open_post/post.interest")</th>
                          <th>@lang("open_post/post.date")</th>
                          <th>@lang("open_post/post.action")</th>
                      </tr>
                  </thead>
              </table>
            </form>

          </div>


        </div>
      </div>
    </div>
  </div>
</section>
@stop

@section("css")
  <link rel="stylesheet" href="{{asset("css/jquery.dataTables.min.css")}}">
@stop

@section("top_include")
  <script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
@stop

@section("jquery")
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url("api/post/list/".$id."/1") }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'interest', name: 'interest' },
            { data: 'date', name: 'date' },
            { data: 'action', name: 'action' },
        ],
        "columnDefs": [{
          "targets": 'no-sort',
          "orderable": false,
        }]
      });
      var checked = false;
      $(".parent_delete_ids").on("click",function(){
        checked = this.checked;
        $(".delete_ids").prop("checked",checked);
      });

      $("#bulk_delete").on("click",function(){
        $("#massDelete").submit();
      });
@stop
