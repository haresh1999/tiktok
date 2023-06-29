@extends($adminTheme)

@section('title','Post Create')

@section('content')
<section class="content-header">
	<!-- <h1>Post</h1> -->
	<!-- <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">Dashboard</li>
    </ol> -->
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Post Create</h3>
		</div>
		<div class="box-body">
			<form action="{{ route('post.store')}}" method="Post" autocomplete="off" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="form-group col-md-6">
						<label>Title</label>
						<input type="text" name="title" class="form-control" value="{{ old('title') }}">
						@error('title') <font color="red"> <small> {{$message}} </small></font> @enderror
					</div>
					<div class="form-group col-md-6">
						<label>Location</label>
						<input type="text" name="location" class="form-control" value="{{ old('location') }}">
						@error('location') <font color="red"> <small> {{$message}} </small></font> @enderror
					</div>

					<div class="form-group col-md-6">
						<label>Type</label>
						<select class="form-control" name="type">
							<option {{ ! is_null(old('type')) && old('type')==0 ? 'selected' : '' }} value="image">Image
							</option>
							<option {{ ! is_null(old('type')) && old('type')==1 ? 'selected' : '' }} value="video"
								selected>Video</option>
						</select>
						@error('type') <font color="red"> <small> {{$message}} </small></font> @enderror
					</div>

					<div class="form-group col-md-6">
						<label>Image or Video</label>
						<input type="file" name="file" class="form-control">
						@error('file') <font color="red"> <small> {{$message}} </small></font> @enderror
					</div>

					<div class="form-group col-md-6">
						<label>Status</label>
						<select class="form-control" name="status">
							<option {{ ! is_null(old('status')) && old('status')==0 ? 'selected' : '' }} value="0">
								Inactive</option>
							<option {{ ! is_null(old('status')) && old('status')==1 ? 'selected' : '' }} value="1"
								selected>Active</option>
						</select>
					</div>

					<div class="form-group col-md-6">
						<label>Description</label>
						<textarea name="description" class="form-control" rows="3"></textarea>
						@error('description') <font color="red"> <small> {{$message}} </small></font> @enderror
					</div>
				</div>

				<div class="form-group">
					<input type="submit" value="Submit" class="btn btn-primary btn-flat">
				</div>
			</form>
		</div>
	</div>
</section>

@endsection