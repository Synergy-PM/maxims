@extends('layout.master')
@section('title', 'Dashboard')
@section('header-title', 'Deleted Users')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>S:NO</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name ?? 'N/A' }}</td>
                                <td>{{ $user->email ?? 'N/A' }}</td>
                                <td>
                                    @if ($user->roles->isNotEmpty())
                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-primary me-1">{{ ucfirst($role->name) }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-white">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @can('user_restore')
                                        <a href="{{ route('user.restore', $user->id) }}" class="btn btn-sm btn-success"
                                            onclick="return confirm('Are you sure you want to restore this User?')">
                                            Restore
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
