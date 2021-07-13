@extends('admin.layout.index')
@section('content')

<!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">List</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{URL::to('admin')}}">Home</a></li>
              <li class="breadcrumb-item">Category</li>
              <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">List</h6>
                </div>
                @if(session('thongbao'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button class="close" aria-label="Close" type="button" data-dismiss="alert"> 
                      <span aria-hidden="true">×</span>
                    </button>
                    {{session('thongbao')}}
                  </div>
                @endif
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($category as $key => $value)
                        
                        <tr>
                          <td>{{$value->id}}</a></td>
                          <td><a href="{{ route('category.edit', ['id' => $value->id]) }}">{{$value['name']}}</td>
                          <td>{{$value->created_at}}</td>
                          <td>{{$value->updated_at}}</td>
                          <td><a href="{{ route('category.edit', ['id' => $value->id]) }}" class="btn btn-sm btn-primary">Edit</a></td>
                          <td><button type="button" class="btn btn-sm btn-danger" 
                            data-catid="{!!$value->id!!}" data-toggle="modal" data-target="#deleteCate">Delete
                            </button>
                          </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>         
        <!---Container Fluid-->
        <!-- Modal -->
          <div class="modal fade" id="deleteCate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{URL::to('admin/category/delete')}}" method="post" accept-charset="utf-8">
                  @csrf
                  <div class="modal-body">
                    <p>Delete?</p>
                    <input type="hidden" name="category_id" id="cate_id" value="">
                  </div>
                  <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
@endsection

@section('script')
<script src="{{asset('backend/js/custom.js')}}"></script>
@endsection