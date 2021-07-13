
@extends('admin.layout.index')
@section('css')
  <link href="{{asset('backend/css/custom.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<?php
use App\Helper\helper;
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">List Post</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{URL::to('admin')}}">Home</a></li>
      <li class="breadcrumb-item">post</li>
      <li class="breadcrumb-item active" aria-current="page">list</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    
    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div>
        <div class="col-sm-12 col-md-6">
          <div class="dataTables_filter" id="dataTable_filter">
            <label>Search:
              <input class="form-control form-control-sm" aria-controls="dataTable"  placeholder="search by name" onkeyup="searchFunction()" id="searchNamePost">
            </label>
          </div>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th width="10%">Name</th>
                <th width="5%">Category</th>
                <th width="10%">Content</th>
                <th width="10%">Image</th>
                <th width="2%">Views</th>
                <th width="5%">Update At</th>                
                <th width="3%">Delete</th>
                
              </tr>
            </thead>
            
            <tbody>
              @foreach($post as $value)
                <tr>
                  <td><a href="{{ route('post.edit', ['id' => $value->id]) }}">{{$value->name}}</a></td>
                  <td>{{$value->category}}</td>
                  <td>{!!Helper::createDescription($value->content, 200, 250)!!}</td>
                  <td><img style="max-width:200px ; height:auto; display:block;" class="img-fluid" 
                    src="{{URL::to('/')}}/upload/post/{{$value->images}}"/></td>
                  <td>{{$value->soluotxem}}</td>
                  <td>{{$value->updated_at}}</td>
                  <td><button type="button" class="btn btn-sm btn-danger" 
                        data-postid="{!!$value->id!!}" data-toggle="modal" data-target="#deletePost">Delete
                      </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="row">
            <div class="col-sm-12 col-md-8">
            </div>
            <div class="col-sm-12 col-md-4">
              <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                {!! $post->links() !!}
              </div>          
            </div>
          </div>
          
          
        </div>
      </div>
    </div>

    <!-- Modal -->
          <div class="modal fade" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{URL::to('admin/post/delete')}}" method="post" accept-charset="utf-8">
                  @csrf
                  <div class="modal-body">
                    <p>Delete?</p>
                    <input type="hidden" name="post_id" id="post_id" value="">
                  </div>
                  <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
  </div>

  <!--Row-->

 

  


<!---Container Fluid-->

@endsection

@section('script')
<script src="{{asset('backend/js/custom.js')}}"></script>
<script>
function searchFunction() {

  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchNamePost");
  filter = input.value.toUpperCase();
  
  table = document.getElementById("dataTableHover");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

$('#deletePost').on('show.bs.modal',function(event){
      
      var button = $(event.relatedTarget);
      var post_id = button.data('postid');
      var modal = $(this);

      modal.find(".modal-body #post_id").val(post_id);
      
});
</script>
@endsection