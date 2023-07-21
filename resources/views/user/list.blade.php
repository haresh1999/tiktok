@extends('layout.master')

@section('title','User List')

@section('content')
<section class="content">
    @if (session('user.success'))
    <div class="alert alert-success">{{ session('user.success') }}</div>
    @endif
    @if (session('user.error'))
    <div class="alert alert-danger">{{ session('user.error') }}</div>
    @endif
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">User List</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Register Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td>{!! $user->status == 'Active' ? '<span class="label label-success">Active</span>' : '<span
                                class="label label-danger">InActive</span>' !!}</td>
                        <td>
                            {{ $user->created_at }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right paginate">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</section>
@endsection