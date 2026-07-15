@extends('layout.master')

@section('title', 'Add Client')
@section('header-title', 'Add Client')

@section('content')

    <div class="content-page">
        <div class="content">
            <div class="container">

                <!-- TOP BAR -->
                <div class="py-3 d-flex justify-content-between align-items-center">
                    <h4 class="fs-18 fw-semibold m-0">Add New Client</h4>
                    <a href="{{ route('client.index') }}" class="btn btn-secondary btn-sm">Back</a>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <!-- HEADER -->
                            <div class="card-header">
                                <h5 class="mb-0">Client Information</h5>
                            </div>

                            <div class="card-body">

                                <!-- GLOBAL ERRORS -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $e)
                                                <li>{{ $e }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('client.store') }}" method="POST">
                                    @csrf

                                    <div class="row">

                                        <!-- FULL NAME -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Full Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                    class="form-control" placeholder="Enter full name">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- COMPANY -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Company Name</label>
                                                <input type="text" name="company_name" value="{{ old('company_name') }}"
                                                    class="form-control" placeholder="Enter company name">
                                            </div>
                                        </div>

                                        <!-- PASSPORT -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Passport Number</label>
                                                <input type="text" name="passport_number"
                                                    value="{{ old('passport_number') }}" class="form-control"
                                                    placeholder="AA1234567">
                                            </div>
                                        </div>

                                        <!-- CNIC -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">CNIC Number</label>
                                                <input type="text" name="cnic" value="{{ old('cnic') }}"
                                                    class="form-control" placeholder="XXXXX-XXXXXXX-X">
                                            </div>
                                        </div>

                                        <!-- PHONE -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Phone Number</label>
                                                <input type="text" name="phone" value="{{ old('phone') }}"
                                                    class="form-control" placeholder="+92 300 0000000">
                                            </div>
                                        </div>

                                        <!-- TYPE -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Type <span class="text-danger">*</span></label>
                                                <select name="type" class="form-control">
                                                    <option value="">Select Type</option>
                                                    <option value="client" {{ old('type') == 'client' ? 'selected' : '' }}>
                                                        Client</option>
                                                    <option value="vendor" {{ old('type') == 'vendor' ? 'selected' : '' }}>
                                                        Vendor</option>
                                                </select>
                                                @error('type')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Package Type</label>
                                            <select name="package_type" class="form-select" required>
                                                <option value="">-- Select --</option>
                                                <option value="hajj"
                                                    {{ old('package_type', $client->package_type ?? '') == 'hajj' ? 'selected' : '' }}>
                                                    Hajj</option>
                                                <option value="umrah"
                                                    {{ old('package_type', $client->package_type ?? '') == 'umrah' ? 'selected' : '' }}>
                                                    Umrah</option>
                                            </select>
                                            @error('package_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- STATUS -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="active"
                                                        {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="inactive"
                                                        {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <!-- SUBMIT -->
                                    <div class="row">
                                        <div class="col-12 text-end">
                                            <button type="submit" class="btn btn-primary px-4">
                                                Save Client
                                            </button>
                                            <a href="{{ route('client.index') }}" class="btn btn-secondary">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
