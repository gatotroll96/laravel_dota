@extends('admin.layout.index')
@section('content')



<!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Category</li>
              <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
                </div>
                @if(count($errors) > 0)                	
                	@foreach($errors->all() as $key => $value)
                		<div class="alert alert-danger" role="alert">
                			{!! $value !!}
                		</div>        
                	@endforeach           		
           		@endif




                <div class="card-body">
                  <form action="{{ route('category.edit.post', ['id' => $id]) }}" method="post">
                  	{{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="{{$nameCate}}" value="{{ old('name') }}">
                      
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
             </div>
@endsection