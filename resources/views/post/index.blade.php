@extends($adminTheme)

@section('title','Post')

@section('content')
<section class="content">

  <div class="box box-primary">
    <div class="box-header with-border">
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      <h3 class="box-title">Post List</h3>
      <div class="pull-right">
        <a href="{{ route('post.create')}}" class="btn btn-info btn-xs btn-flat"><i class="fa fa-plus-square"
            aria-hidden="true"></i> &nbsp; Add Post</a>
      </div>
    </div>
    <div class="box-body">
      <table class="table table-bordered table-striped text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Category</th>
            <th>Location</th>
            <th>Type</th>
            <th>Image Or Video</th>
            <th>Likes</th>
            <th>Views</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach($posts as $key => $post)
          <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->name }}</td>
            <td>{{ $post->location }}</td>
            <td>{{ Str::ucfirst($post->type) }}</td>
            <td>
              <a target="_blank" href="{{ $post->filename }}">
                <i class="fa fa-eye"></i>
              </a>
            </td>
            <td>
              {{ $post->likes }}
            </td>
            <td>
              {{ $post->views }}
            </td>
            <td>{!! $post->status == 1 ? '<span class="label label-success">Active</span>' : '<span
                class="label label-danger">InActive</span>' !!}</td>
            <td>
              <a href="{{ route('post.edit',$post->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            </td>
            <td>
              <a onclick="return confirm('Are you sure, once you confirm record is permanently deleted!')"
                href="{{ route('post.delete',$post->id) }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection