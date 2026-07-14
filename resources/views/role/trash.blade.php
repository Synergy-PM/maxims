@extends('layout.master')
@section('title', 'Dashboard')
@section('header-title', 'Deleted Roles')

@section('content')


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
                                     
                                    {{-- @can('user_restore') --}}
                                        <a href="{{ route('role.restore', $role->id) }}"
                                        class="btn btn-sm btn-success"
                                        onclick="return confirm('Are you sure you want to restore this User?')">
                                        Restore
                                    </a>
                                    {{-- @endcan --}}
                            
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>


@endsection
