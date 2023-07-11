@extends($adminTheme)

@section('title','Category')

@section('content')
<section class="content">
    @if (session('category.success'))
    <div class="alert alert-success">{{ session('category.success') }}</div>
    @endif
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Category List</h3>
            <div class="pull-right">
                <a href="{{ route('category.create')}}" class="btn btn-info btn-sm btn-flat"><i
                        class="fa fa-plus-square" aria-hidden="true"></i> &nbsp; Add Category</a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Likes</th>
                        <th>Views</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{!! $category->status == 1 ? '<span class="label label-success">Active</span>' : '<span
                                class="label label-danger">InActive</span>' !!}</td>
                        <td>{{ $category->likes }}</td>
                        <td>{{ $category->views }}</td>
                        <td>
                            <img width="100" height="50" src="{{ getImageUrl($category->img) }}" alt="img">
                        </td>
                        <td><a href="{{ route('category.edit',$category->id)}}"><i class="fa fa-pencil-square-o"
                                    aria-hidden="true"></i></a></td>
                        <td>
                            <a onclick="return confirm('Are you sure, once you confirm record is permanently deleted!')"
                                href="{{ route('category.delete',$category->id) }}">
                                <i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection