@extends('layout.master')

@section('title', 'Package Details')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="py-3 d-flex align-items-center justify-content-between no-print">
                    <h4 class="fs-18 fw-semibold m-0">Package / <strong>{{ $package->name }}</strong></h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('package.pdf', $package->id) }}" class="btn btn-danger">
                            <i class="mdi mdi-file-pdf-box"></i> Download PDF
                        </a>
                        <a href="{{ route('package.edit', $package->id) }}" class="btn btn-warning">
                            <i class="mdi mdi-pencil"></i> Edit
                        </a>
                        <a href="{{ route('package.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                @include('package.partials.brochure', ['package' => $package, 'forPdf' => false])

            </div>
        </div>
    </div>
@endsection
