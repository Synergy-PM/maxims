@extends('layout.master')
@section('title', 'Edit User')
@section('header-title', 'Edit User')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="name"><b>Name</b><span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" value="{{ $user->name }}"
                                        placeholder="Enter Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="email"><b>Email</b></label>
                                    <input type="email" id="email" name="email" value="{{ $user->email }}"
                                        placeholder="Enter Email" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="mb-3">
                                    <label for="status"><b>Status</b></label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="" disabled>Select Status</option>
                                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="mb-3">
                                    <label for="roles"><b>Assign Role(s)</b></label>
                                    <select name="roles[]" id="roles" class="form-control select2" multiple>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mt-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-sm px-3 d-flex align-items-center gap-1">
                                    <i class="material-icons-outlined" style="font-size:16px;">save</i>
                                    Update User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#roles').select2({
                placeholder: "Select Role(s)"
            });
        });
    </script>
@endsection
