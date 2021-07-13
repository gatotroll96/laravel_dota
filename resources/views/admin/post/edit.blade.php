@extends('admin.layout.index')
@section('content')

<?php
echo '<pre>';
  print_r($data);
  echo '</pre>';

?>


<div class="row">
	<div class="col-lg-6">
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
              <form action="{{ route('post.save.edit', ['id' => $data[0]->id]) }}" method="post" enctype="multipart/form-data">
              	{{ csrf_field() }}
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>

                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" 
                  @if(!empty($data[0]->name))
                    value="{{$data[0]->name}}"                    
                  @else
                    value="{{old('name')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Category</label>
                  <select class="select2-single form-control" name="category" id="select2Single">
                  	<option value="default">Select Category</option>
                  	@foreach($category as $value)
                  		<option value="{{$value->id}}" 
                      {{ old("category") == $value->id || $data[0]->category_id == $value->id ? "selected" : "" }}>
                      {{$value->name}}
                      </option>
                    @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Content</label>
                  <textarea name="content" id="editor" >
                    @if(!empty($data[0]->content))
                       {{$data[0]->content}}
                    @else
                       {{ old("content")}}
                    @endif
                  </textarea>
                </div>

                <div class="form-group">
                  @if(!empty($data[0]->images))
                    <label for="exampleInputEmail1">Image</label>
                    <img style="max-width:60% ; height:auto; display:block;" src="{{URL::to('/')}}/upload/post/{{$data[0]->images}}"/>                  
                  @endif
                </div>
                <input type="hidden" name="checkImg" value="{{$data[0]->images}}">
               
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