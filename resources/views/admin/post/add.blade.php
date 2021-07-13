@extends('admin.layout.index')
@section('content')

<!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Add Post</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{URL::to('admin')}}">Home</a></li>
        <li class="breadcrumb-item">Post</li>
        <li class="breadcrumb-item active" aria-current="page">Add Post</li>
      </ol>
    </div>


<div class="row">
	<div class="col-lg-12">
		<div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Form Basic</h6>
            </div>
             @if(count($errors) > 0)                	
            	@foreach($errors->all() as $key => $value)
            		<div class="alert alert-danger" role="alert">
            			{!! $value !!}
            		</div>        
            	@endforeach           		
           	@endif
            <div class="card-body">
              <form action="{{URL::to('admin/post/add')}}" method="post" enctype="multipart/form-data">
              	{{ csrf_field() }}
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Category</label>
                  <select class="select2-single form-control" name="category" id="select2Single">
                  	<option value="default">Select Category</option>
                  	@foreach($category as $value)
                  		<option value="{{$value->id}}" {{ old("category") == $value->id ? "selected" : "" }}>{{$value->name}}</option>
                    @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Content</label>
                  <textarea name="content" id="editor" >{{ old('content') }}</textarea>
                </div>
               
                <div class="form-group">
                	<label for="exampleInputEmail1">Choose file Image</label>
	                <div class="custom-file">
	                   <label for="myfile">Select a file:</label>
 						<input type="file" id="myfile" name="img">
	                </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
	</div>
</div>
</div>

@endsection


@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
</script>
@endsection