@extends('layout.master')
@section('title', 'Users')
@section('header-title', 'Users')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase">All Users</h6>
            <div class="mb-1 d-flex gap-2">
                @can('user_create')
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm px-3 d-flex align-items-center gap-1">
                        <i class="material-icons-outlined" style="font-size:16px;">add</i>
                        Add User
                    </a>
                @endcan
                @can('user_trash_view')
                    <a href="{{ route('user.trash') }}" class="btn btn-danger btn-sm px-3 d-flex align-items-center gap-1">
                        <i class="material-icons-outlined" style="font-size:16px;">delete</i>
                        Trash
                        <span class="badge bg-light text-dark">{{ $trashuser ?? 0 }}</span>
                    </a>
                @endcan
            </div>
        </div>
    </div>
    <hr>
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
                                    <div class="d-inline-flex gap-2">
                                        @can('user_edit')
                                            <a href="{{ route('user.edit', $user->id) }}"
                                                class="btn btn-outline-success btn-sm d-flex align-items-center justify-content-center">
                                                <i class="material-icons-outlined">edit</i>
                                            </a>
                                        @endcan
                                        @can('user_trash')
                                            <form action="{{ route('user.delete', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this User?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center">
                                                    <i class="material-icons-outlined">delete</i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>

@endsection
