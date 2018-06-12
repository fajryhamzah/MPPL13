@extends("layout.index_dashboard")
@section("content")
@include("layout.menu.afterLogin")
<section>
  <div class="row">

    <div id="modal1" class="modal">
      <div class="modal-content">
        <h4>@lang("open_post/post.sure")</h4>
        <p>@lang("open_post/post.sure_text")</p>
      </div>
      <div class="modal-footer">
        <a href="#!" id="delLink" class="modal-action modal-close waves-effect waves-green btn-flat">@lang("open_post/post.yes")</a>
        <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">@lang("open_post/post.no")</a>
      </div>
    </div>

    <div class="col s12">
      @include("open_adopt.side")
      <div class="col s7 content">
        <div class="col s12 offset-s2">
          <div id="una">
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

          <div id="ado">
            <div class="col s12">
              <div class="col s6">
                <h4>@lang("open_post/post.header_adopted")</h4>
              </div>
            </div>

            <div class="col s12">
                <table class="table table-bordered" id="table2">
                    <thead>
                        <tr>
                            <th>@lang("open_post/post.name")</th>
                            <th>@lang("open_post/post.interest")</th>
                            <th>@lang("open_post/post.date")</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
$('.setting-nav').tabs();
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

      $('#table2').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ url("api/post/list/".$id."/0") }}',
          columns: [
              { data: 'name', name: 'name' },
              { data: 'interest', name: 'interest' },
              { data: 'date', name: 'date' },
          ],
        });

      var checked = false;
      $(".parent_delete_ids").on("click",function(){
        checked = this.checked;
        $(".delete_ids").prop("checked",checked);
      });
      var page = 0; //0 for bulk
      var nextLink;

      $("#bulk_delete").on("click",function(){
        page = 0;
        $(".modal").modal().modal("open");
      });

      $("#table").on("click",".delete-link",function(){
        page = 1;
        nextLink = $(this).attr("data-link");
        $(".modal").modal().modal("open");
      });

      $("#delLink").on("click",function(){
        if(page == 0){
          $("#massDelete").submit();
        }else{
          window.location = nextLink;
        }
      });
@stop
