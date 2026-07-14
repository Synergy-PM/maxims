@extends('layout.master')
@section('title', 'Change Password')
@section('header-title', 'Change Password')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.change-password') }}">
                        @csrf
                        <div class="row">
                            {{-- Current Password --}}
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="current_password"><b>Current Password</b><span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="current_password" id="current_password"
                                        placeholder="Enter Current Password" class="form-control" required>
                                    @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- New Password --}}
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="new_password"><b>New Password</b><span class="text-danger">*</span></label>
                                    <input type="password" name="new_password" id="new_password"
                                        placeholder="Enter New Password" class="form-control" required>
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Confirm Password --}}
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="new_password_confirmation"><b>Confirm Password</b><span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                        placeholder="Confirm Password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary"><b>Change Password</b></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
