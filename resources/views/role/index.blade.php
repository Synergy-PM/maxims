@extends('layout.master')
@section('title', 'Roles')
@section('header-title', 'Roles')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase">All Roles</h6>
            <div class="mb-1 d-flex gap-2">
                @can('role_create')
                    <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm px-3 d-flex align-items-center gap-1">
                        <i class="material-icons-outlined" style="font-size:16px;">add</i>
                        Add Role
                    </a>
                @endcan
                @can('role_trash_view')
                    <a href="{{ route('role.trash') }}" class="btn btn-danger btn-sm px-3 d-flex align-items-center gap-1">
                        <i class="material-icons-outlined" style="font-size:16px;">delete</i>
                        Trash
                        <span class="badge bg-light text-dark">{{ $trashrole ?? 0 }}</span>
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
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-2">
                                        @can('role_edit')
                                            <a href="{{ route('role.edit', $role->id) }}"
                                                class="btn btn-outline-success btn-sm d-flex align-items-center justify-content-center">
                                                <i class="material-icons-outlined">edit</i>
                                            </a>
                                        @endcan
                                        @can('role_trash')
                                            <form action="{{ route('role.delete', $role->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this role?');">
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
