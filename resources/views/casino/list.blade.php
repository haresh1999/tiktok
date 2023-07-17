@extends('layout.master')

@section('title','Casino List')

@section('content')
<section class="content">
    @if (session('casino.success'))
    <div class="alert alert-success">{{ session('casino.success') }}</div>
    @endif
    @if (session('casino.error'))
    <div class="alert alert-danger">{{ session('casino.error') }}</div>
    @endif
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Casino List</h3>
            <div class="pull-right">
                <a href="{{ route('casino.create')}}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-plus-square"
                        aria-hidden="true"></i> &nbsp; Add Casino</a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Banner Title</th>
                        <th>Title</th>
                        <th>Rating</th>
                        <th>URL</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($casinos as $key => $casino)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $casino->banner_title }}</td>
                        <td>{{ $casino->title }}</td>
                        <td>{{ $casino->rating }}</td>
                        <td>
                            <a href="{{ $casino->url }}"><i class="fa fa-eye"></i></a>
                        </td>
                        <td>
                            <img width="100" height="50" src="{{ getImageUrl($casino->img) }}" alt="img">
                        </td>
                        <td>{!! $casino->status == 1 ? '<span class="label label-success">Active</span>' : '<span
                                class="label label-danger">InActive</span>' !!}</td>
                        <td><a href="{{ route('casino.edit',$casino->id)}}"><i class="fa fa-pencil-square-o"
                                    aria-hidden="true"></i></a></td>
                        <td>
                            <a onclick="return confirm('Are you sure, once you confirm record is permanently deleted!')"
                                href="{{ route('casino.delete',$casino->id) }}">
                                <i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right paginate">
                {{ $casinos->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</section>
@endsection