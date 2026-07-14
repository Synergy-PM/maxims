@extends('layout.master')
@section('title', 'Companies')
@section('header-title', 'Companies')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase">All Companies</h6>
            <div class="mb-1 d-flex gap-2">
                {{-- @can('company_create') --}}
                    <a href="{{ route('company.create') }}" class="btn btn-primary btn-sm px-3 d-flex align-items-center gap-1">
                        <i class="material-icons-outlined" style="font-size:16px;">add</i>
                        Add Company
                    </a>
                {{-- @endcan --}}
                {{-- @can('company_trash_view') --}}
                    <a href="{{ route('company.trash') }}" class="btn btn-danger btn-sm px-3 d-flex align-items-center gap-1">
                        <i class="material-icons-outlined" style="font-size:16px;">delete</i>
                        Trash
                        <span class="badge bg-light text-dark">{{ $trashcompany ?? 0 }}</span>
                    </a>
                {{-- @endcan --}}
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
                            <th>Company Name</th>
                            <th>Company Code</th>
                            <th>Established Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $company->company_name ?? 'N/A' }}</td>
                                <td>{{ $company->company_code ?? 'N/A' }}</td>
                                <td>{{ $company->established_on ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-2">
                                        {{-- @can('company_edit') --}}
                                            <a href="{{ route('company.edit', $company->id) }}"
                                                class="btn btn-outline-success btn-sm d-flex align-items-center justify-content-center">
                                                <i class="material-icons-outlined">edit</i>
                                            </a>
                                        {{-- @endcan --}}
                                        {{-- @can('company_destroy') --}}
                                            <form action="{{ route('company.delete', $company->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this Company?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center">
                                                    <i class="material-icons-outlined">delete</i>
                                                </button>
                                            </form>
                                        {{-- @endcan --}}
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
