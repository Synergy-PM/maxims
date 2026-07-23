@extends('layout.master')

@section('title', 'Create Package')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="py-3 d-flex align-items-center justify-content-between">
                    <h4 class="fs-18 fw-semibold m-0">Package / <strong>Create</strong></h4>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('package.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill"
                                data-bs-target="#tab-package" type="button">PACKAGE</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="pill"
                                data-bs-target="#tab-accommodation" type="button">ACCOMMODATION</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-transport"
                                type="button">TRANSPORT</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-training"
                                type="button">TRAINING / GIFTS</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-terms"
                                type="button">TERMS & CONDITION</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-itinerary"
                                type="button">ITINERARY</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-maktab"
                                type="button">MAKTAB ADDRESS</button></li>
                    </ul>

                    <div class="tab-content card">

                        {{-- ================= PACKAGE ================= --}}
                        <div class="tab-pane fade show active card" id="tab-package">
                            <div class="card-body">
                                <h5 class="mb-3">Package Details</h5>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Company</label>
                                        <select name="company_id" class="form-select">
                                            <option value="">-- Select Company --</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                                    {{ $company->company_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Package #</label>
                                        <input type="text" name="package_number" class="form-control" placeholder="e.g. PKG-001"
                                            value="{{ old('package_number') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Category</label>
                                        <input type="text" name="category" class="form-control" placeholder="e.g. VIP"
                                            value="{{ old('category') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Zone</label>
                                        <input type="text" name="zone" class="form-control" placeholder="e.g. Zone A"
                                            value="{{ old('zone') }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Package Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="e.g. Premium Hajj Package"
                                            value="{{ old('name') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Package Code</label>
                                        <input type="text" name="code" class="form-control" placeholder="e.g. HJ-2027-01"
                                            value="{{ old('code') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Days</label>
                                        <input type="number" min="0" name="days" class="form-control" placeholder="e.g. 21"
                                            value="{{ old('days') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Year</label>
                                        <input type="text" name="year" class="form-control" placeholder="e.g. 2027"
                                            value="{{ old('year', date('Y') + 1) }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Maktab</label>
                                        <input type="text" name="maktab" class="form-control" placeholder="e.g. Maktab 5"
                                            value="{{ old('maktab') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Maktab Number</label>
                                        <input type="text" name="maktab_number" class="form-control" placeholder="e.g. 105"
                                            value="{{ old('maktab_number') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label d-block">Medina Arrival</label>
                                        @foreach (['before_hajj' => 'Before Hajj', 'after_hajj' => 'After Hajj'] as $val => $label)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="medina_arrival"
                                                    value="{{ $val }}"
                                                    {{ old('medina_arrival', 'before_hajj') == $val ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label d-block">Hajj Duration</label>
                                        @foreach (['short' => 'Short', 'long' => 'Long'] as $val => $label)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="hajj_duration"
                                                    value="{{ $val }}"
                                                    {{ old('hajj_duration', 'short') == $val ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <hr class="my-4">
                                <h5 class="mb-3">Package Category</h5>
                                <div class="row g-3 mt-1">
                                    <div class="col-md-3">
                                        <label class="form-label">Room Type</label>
                                        <input type="text" name="room_type" class="form-control" placeholder="e.g. Standard"
                                            value="{{ old('room_type') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Azizia Room Type</label>
                                        <input type="text" name="azizia_room_type" class="form-control" placeholder="e.g. Standard"
                                            value="{{ old('azizia_room_type') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Makkah Type</label>
                                        <select name="makkah_type" class="form-select">
                                            <option value="">-- Select --</option>
                                            @foreach ([1, 2, 3, 4, 5] as $val)
                                                <option value="{{ $val }}"
                                                    {{ old('makkah_type') == $val ? 'selected' : '' }}>{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Medinah Type</label>
                                        <select name="medinah_type" class="form-select">
                                            <option value="">-- Select --</option>
                                            @foreach ([1, 2, 3, 4, 5] as $val)
                                                <option value="{{ $val }}"
                                                    {{ old('medinah_type') == $val ? 'selected' : '' }}>{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Azizia Type</label>
                                        <select name="azizia_type" class="form-select">
                                            <option value="">-- Select --</option>
                                            @foreach ([1, 2, 3] as $val)
                                                <option value="{{ $val }}"
                                                    {{ old('azizia_type') == $val ? 'selected' : '' }}>{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Mina Type</label>
                                        <input type="text" name="mina_type" class="form-control" placeholder="e.g. Camp A"
                                            value="{{ old('mina_type') }}">
                                    </div>
                                </div>

                                <hr class="my-4">
                                <h5 class="mb-3">Makkah / Madinah Sharing Breakdown</h5>
                                <div class="row g-3">
                                    @foreach ([
                                        'makkah_a' => 'Makkah A',
                                        'makkah_b' => 'Makkah B',
                                        'madinah_a' => 'Madinah A',
                                        'madinah_b' => 'Madinah B',
                                    ] as $prefix => $heading)
                                        <div class="col-12"><h6 class="mt-2 mb-1">{{ $heading }}</h6></div>
                                        @foreach (['double' => 'Double', 'triple' => 'Triple', 'quad' => 'Quad', 'sharing' => 'Sharing'] as $key => $label)
                                            <div class="col-md-3">
                                                <label class="form-label">{{ $label }}</label>
                                                <input type="number" min="0" name="{{ $prefix }}[{{ $key }}]"
                                                    class="form-control" placeholder="0"
                                                    value="{{ old("$prefix.$key") }}">
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- ================= ACCOMMODATION ================= --}}
                        <div class="tab-pane fade card" id="tab-accommodation">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="m-0">Accommodation Details</h5>
                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                        id="addAccommodationBtn">Add <i class="mdi mdi-plus"></i></button>
                                </div>

                                <div id="accommodationRows">
                                    <div class="accommodation-row border rounded p-3 mb-3 position-relative">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger remove-accommodation-row position-absolute top-0 end-0 m-2"><i
                                                class="mdi mdi-delete"></i></button>
                                        <div class="row g-3">
                                            <div class="col-md-3"><label class="form-label">Place</label>
                                                <select name="accommodations[0][place]" class="form-select">
                                                    <option value="">-- Select Place --</option>
                                                    @foreach (\App\Enums\Place::options() as $val => $label)
                                                        <option value="{{ $val }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Accommodation Type</label>
                                                <select name="accommodations[0][accommodation_type]" class="form-select">
                                                    <option value="">-- Select Type --</option>
                                                    @foreach (\App\Enums\AccommodationType::options() as $val => $label)
                                                        <option value="{{ $val }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Saudi Star Rating</label>
                                                <select name="accommodations[0][saudi_star_rating]" class="form-select">
                                                    <option value="">-- Select Rating --</option>
                                                    @foreach (\App\Enums\SaudiStarRating::options() as $val => $label)
                                                        <option value="{{ $val }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Hotel</label>
                                                <select name="accommodations[0][hotel]" class="form-select">
                                                    <option value="">-- Select Hotel --</option>
                                                    @foreach (\App\Enums\Hotel::options() as $val => $label)
                                                        <option value="{{ $val }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3"><label class="form-label">Distance (meter)</label><input
                                                    type="number" name="accommodations[0][distance]"
                                                    class="form-control"></div>
                                            <div class="col-md-3"><label class="form-label">Check In</label><input
                                                    type="date" name="accommodations[0][check_in]"
                                                    class="form-control"></div>
                                            <div class="col-md-3"><label class="form-label">Check Out</label><input
                                                    type="date" name="accommodations[0][check_out]"
                                                    class="form-control"></div>
                                            <div class="col-md-3"><label class="form-label">Food Package</label>
                                                <select name="accommodations[0][food_package]" class="form-select">
                                                    <option value="">-- Select Package --</option>
                                                    @foreach (\App\Enums\FoodPackage::options() as $val => $label)
                                                        <option value="{{ $val }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4"><label class="form-label">Actual Check In
                                                    Time</label><input type="datetime-local"
                                                    name="accommodations[0][actual_check_in_time]" class="form-control">
                                            </div>
                                            <div class="col-md-4"><label class="form-label">Actual Check Out
                                                    Time</label><input type="datetime-local"
                                                    name="accommodations[0][actual_check_out_time]" class="form-control">
                                            </div>

                                            <div class="col-md-3"><label class="form-label">Days</label><input
                                                    type="number" name="accommodations[0][days]" class="form-control">
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Nights</label><input
                                                    type="number" name="accommodations[0][nights]" class="form-control">
                                            </div>

                                            <div class="col-md-3"><label class="form-label">Makkah Ziarat</label>
                                                <select name="accommodations[0][makkah_ziarat]" class="form-select">
                                                    <option value="">-- Select --</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Madinah Ziarat</label>
                                                <select name="accommodations[0][madinah_ziarat]" class="form-select">
                                                    <option value="">-- Select --</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4"><label class="form-label">Distribution</label><input
                                                    type="text" name="accommodations[0][distribution]"
                                                    class="form-control"></div>
                                            <div class="col-md-4"><label class="form-label">Camp</label><input
                                                    type="text" name="accommodations[0][camp]" class="form-control">
                                            </div>
                                            <div class="col-md-4"><label class="form-label">Arafat</label><input
                                                    type="text" name="accommodations[0][arafat]" class="form-control">
                                            </div>

                                            <div class="col-md-4"><label class="form-label"> Azizia Shuttle</label><input
                                                    type="text" name="accommodations[0][shuttle]"
                                                    class="form-control"></div>
                                            <div class="col-md-4"><label class="form-label">Bedding (Sofa
                                                    Mattress)</label><input type="text"
                                                    name="accommodations[0][bedding]" class="form-control"></div>
                                            <div class="col-md-4"><label class="form-label">Sharing (Room / Tent /
                                                    Camp)</label><input type="text" name="accommodations[0][sharing]"
                                                    class="form-control"></div>

                                            <div class="col-md-4"><label class="form-label">Sharing Type</label><input
                                                    type="text" name="accommodations[0][sharing_type]"
                                                    class="form-control"></div>
                                            <div class="col-md-8"><label class="form-label">Note</label><input
                                                    type="text" name="accommodations[0][note]" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ================= TRANSPORT ================= --}}
                        <div class="tab-pane fade card" id="tab-transport">
                            <div class="card-body">

                                {{-- ---- General Route (repeatable) ---- --}}
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="m-0">Transport Details</h5>
                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                        id="addTransportBtn">Add <i class="mdi mdi-plus"></i></button>
                                </div>

                                <div id="transportRows">
                                    <div class="transport-row border rounded p-3 mb-3 position-relative">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger remove-transport-row position-absolute top-0 end-0 m-2"><i
                                                class="mdi mdi-delete"></i></button>
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Route</label>
                                                <input type="text" name="transports[0][route]" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Arrival</label>
                                                <input type="text" name="transports[0][arrival]" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Departure</label>
                                                <input type="text" name="transports[0][departure]"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Type</label>
                                                <input type="text" name="transports[0][type]" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Vehicle</label>
                                                <input type="text" name="transports[0][vehicle]" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                {{-- ---- Flight ---- --}}
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="m-0">Flight</h5>
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="addFlightBtn">Add
                                        <i class="mdi mdi-plus"></i></button>
                                </div>

                                <div id="flightRows">
                                    <div class="flight-row border rounded p-3 mb-3 position-relative">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger remove-flight-row position-absolute top-0 end-0 m-2"><i
                                                class="mdi mdi-delete"></i></button>
                                        <div class="row g-3">
                                            <div class="col-md-3"><label class="form-label">Airline</label><input
                                                    type="text" name="flights[0][airline]" class="form-control"></div>
                                            <div class="col-md-3"><label class="form-label">Flight No.</label><input
                                                    type="text" name="flights[0][flight_no]" class="form-control">
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Flight Class</label><input
                                                    type="text" name="flights[0][flight_class]" class="form-control">
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Origin</label><input
                                                    type="text" name="flights[0][origin]" class="form-control"></div>

                                            <div class="col-md-3"><label class="form-label">Destination</label><input
                                                    type="text" name="flights[0][destination]" class="form-control">
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Departure Date</label><input
                                                    type="date" name="flights[0][departure_date]"
                                                    class="form-control"></div>
                                            <div class="col-md-3"><label class="form-label">Departure Time</label><input
                                                    type="time" name="flights[0][departure_time]"
                                                    class="form-control"></div>
                                            <div class="col-md-3"><label class="form-label">Arrival Date</label><input
                                                    type="date" name="flights[0][arrival_date]" class="form-control">
                                            </div>

                                            <div class="col-md-3"><label class="form-label">Arrival Time</label><input
                                                    type="time" name="flights[0][arrival_time]" class="form-control">
                                            </div>
                                            <div class="col-md-3"><label class="form-label">PNR No.</label><input
                                                    type="text" name="flights[0][pnr_no]" class="form-control"></div>
                                            <div class="col-md-3"><label class="form-label">Ticket Amount
                                                    (SAR)</label><input type="number" step="0.01"
                                                    name="flights[0][ticket_amount]" class="form-control"></div>
                                            <div class="col-md-3">
                                                <label class="form-label d-block">Is Preferred</label>
                                                @foreach (['1' => 'Yes', '0' => 'No'] as $val => $label)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="flights[0][is_preferred]" value="{{ $val }}"
                                                            {{ $val == '0' ? 'checked' : '' }}>
                                                        <label class="form-check-label">{{ $label }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                {{-- ---- Train ---- --}}
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="m-0">Train</h5>
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="addTrainBtn">Add <i
                                            class="mdi mdi-plus"></i></button>
                                </div>

                                <div id="trainRows">
                                    <div class="train-row border rounded p-3 mb-3 position-relative">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger remove-train-row position-absolute top-0 end-0 m-2"><i
                                                class="mdi mdi-delete"></i></button>
                                        <div class="row g-3">
                                            <div class="col-md-3"><label class="form-label">Railway</label><input
                                                    type="text" name="trains[0][railway]" class="form-control"></div>
                                            <div class="col-md-3"><label class="form-label">Train No.</label><input
                                                    type="text" name="trains[0][train_no]" class="form-control"></div>
                                            <div class="col-md-3"><label class="form-label">Train Class</label><input
                                                    type="text" name="trains[0][train_class]" class="form-control">
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Origin</label><input
                                                    type="text" name="trains[0][origin]" class="form-control"></div>

                                            <div class="col-md-3"><label class="form-label">Destination</label><input
                                                    type="text" name="trains[0][destination]" class="form-control">
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Departure Date</label><input
                                                    type="date" name="trains[0][departure_date]" class="form-control">
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Departure Time</label><input
                                                    type="time" name="trains[0][departure_time]" class="form-control">
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Arrival Date</label><input
                                                    type="date" name="trains[0][arrival_date]" class="form-control">
                                            </div>

                                            <div class="col-md-3"><label class="form-label">Arrival Time</label><input
                                                    type="time" name="trains[0][arrival_time]" class="form-control">
                                            </div>
                                            <div class="col-md-3"><label class="form-label">PNR No.</label><input
                                                    type="text" name="trains[0][pnr_no]" class="form-control"></div>
                                            <div class="col-md-3"><label class="form-label">Ticket Amount
                                                    (SAR)</label><input type="number" step="0.01"
                                                    name="trains[0][ticket_amount]" class="form-control"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- ================= TRAINING / GIFTS ================= --}}
                        <div class="tab-pane fade card" id="tab-training">
                            <div class="card-body">
                                <h5 class="mb-3">Training Session</h5>
                                @if ($trainingSessions->isEmpty())
                                    <p class="text-danger mb-3">No Training Sessions Exists! <a
                                            href="{{ route('training-session.create') }}" target="_blank">Please create
                                            training sessions first</a></p>
                                @else
                                    @php $selectedSessions = old('training_sessions', []); @endphp
                                    @foreach ($trainingSessions as $session)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="training_sessions[]"
                                                value="{{ $session->id }}" id="session-{{ $session->id }}"
                                                {{ in_array($session->id, $selectedSessions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="session-{{ $session->id }}">
                                                {{ $session->name }}
                                                @if ($session->session_date)
                                                    ({{ \Carbon\Carbon::parse($session->session_date)->format('d M, Y') }}
                                                    at
                                                    {{ $session->session_time ? \Carbon\Carbon::parse($session->session_time)->format('h:i A') : '' }})
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                @endif

                                <h5 class="mb-3 mt-4">Giveaways</h5>
                                @php $selectedGiveaways = old('giveaways', []); @endphp
                                @foreach ($giveaways->where('code', 'GW-01') as $g)
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="giveaways[]"
                                            value="{{ $g->id }}" id="giveaway-{{ $g->id }}"
                                            {{ in_array($g->id, $selectedGiveaways) ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="giveaway-{{ $g->id }}">{{ $g->code }} -
                                            {{ $g->name }}</label>
                                    </div>
                                @endforeach

                                <label class="form-label">Giveaway Note</label>
                                <textarea name="giveaway_note" rows="3" class="form-control"
                                    placeholder="Write here what giveaway you are giving...">{{ old('giveaway_note') }}</textarea>
                            </div>
                        </div>

                        {{-- ================= TERMS & CONDITION ================= --}}
                        <div class="tab-pane fade card" id="tab-terms">
                            <div class="card-body">
                                <h5 class="mb-3">Terms & Condition</h5>
                                <textarea name="terms_content" rows="8" class="form-control" placeholder="Write your content here...">{{ old('terms_content') }}</textarea>
                            </div>
                        </div>

                        {{-- ================= ITINERARY ================= --}}
                        <div class="tab-pane fade card" id="tab-itinerary">
                            <div class="card-body">
                                <h5 class="mb-3">Description</h5>
                                <textarea name="itinerary_description" rows="8" class="form-control mb-4"
                                    placeholder="Write your content here...">{{ old('itinerary_description') }}</textarea>

                                <h5 class="mb-3">Images</h5>
                                <div class="row g-3">
                                    @foreach ([
            'mina_image' => 'MINA',
            'arafat_image' => 'ARAFAT',
            'muzdalifah_image' => 'MUZDALIFAH',
            'makkah_mina_rami_day_one_image' => 'MAKKAH / MINA RAMI - DAY ONE',
            'mina_rami_day_two_image' => 'MINA RAMI - DAY TWO',
            'mina_makkah_rami_day_three_image' => 'MINA / MAKKAH RAMI - DAY THREE',
        ] as $field => $label)
                                        <div class="col-md-4">
                                            <label class="form-label">{{ $label }}</label>
                                            <input type="file" name="{{ $field }}" class="form-control">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- ================= MAKTAB ADDRESS ================= --}}
                        <div class="tab-pane fade card" id="tab-maktab">
                            <div class="card-body">
                                <h5 class="mb-3">Maktab Address</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Maktab Address</label>
                                        <input type="text" name="maktab_address" class="form-control"
                                            value="{{ old('maktab_address') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Office Address</label>
                                        <input type="text" name="office_address" class="form-control"
                                            value="{{ old('office_address') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end" style="margin: 20px">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        (function() {
            let accIndex = 1;

            document.getElementById('addAccommodationBtn').addEventListener('click', function() {
                const firstRow = document.querySelector('.accommodation-row');
                const clone = firstRow.cloneNode(true);

                clone.querySelectorAll('input, textarea, select').forEach(function(el) {
                    el.name = el.name.replace(/accommodations\[\d+\]/, 'accommodations[' + accIndex +
                        ']');
                    if (el.tagName === 'SELECT') {
                        el.selectedIndex = 0;
                    } else if (el.type !== 'button') {
                        el.value = '';
                    }
                });

                document.getElementById('accommodationRows').appendChild(clone);
                accIndex++;
            });

            document.getElementById('accommodationRows').addEventListener('click', function(e) {
                if (e.target.closest('.remove-accommodation-row')) {
                    const row = e.target.closest('.accommodation-row');
                    if (document.querySelectorAll('.accommodation-row').length > 1) {
                        row.remove();
                    } else {
                        row.querySelectorAll('input, textarea').forEach(el => el.value = '');
                        row.querySelectorAll('select').forEach(el => el.selectedIndex = 0);
                    }
                }
            });
        })();

        // ---- Transport repeatable rows ----
        (function() {
            let transportIndex = 1;

            document.getElementById('addTransportBtn').addEventListener('click', function() {
                const firstRow = document.querySelector('.transport-row');
                const clone = firstRow.cloneNode(true);

                clone.querySelectorAll('input').forEach(function(el) {
                    el.name = el.name.replace(/transports\[\d+\]/, 'transports[' + transportIndex +
                        ']');
                    el.value = '';
                });

                document.getElementById('transportRows').appendChild(clone);
                transportIndex++;
            });

            document.getElementById('transportRows').addEventListener('click', function(e) {
                if (e.target.closest('.remove-transport-row')) {
                    const row = e.target.closest('.transport-row');
                    if (document.querySelectorAll('.transport-row').length > 1) {
                        row.remove();
                    } else {
                        row.querySelectorAll('input').forEach(el => el.value = '');
                    }
                }
            });
        })();

        // ---- Flight repeatable rows ----
        (function() {
            let flightIndex = 1;

            document.getElementById('addFlightBtn').addEventListener('click', function() {
                const firstRow = document.querySelector('.flight-row');
                const clone = firstRow.cloneNode(true);

                clone.querySelectorAll('input').forEach(function(el) {
                    el.name = el.name.replace(/flights\[\d+\]/, 'flights[' + flightIndex + ']');
                    if (el.type === 'radio') {
                        el.checked = el.value === '0';
                    } else {
                        el.value = '';
                    }
                });

                document.getElementById('flightRows').appendChild(clone);
                flightIndex++;
            });

            document.getElementById('flightRows').addEventListener('click', function(e) {
                if (e.target.closest('.remove-flight-row')) {
                    const row = e.target.closest('.flight-row');
                    if (document.querySelectorAll('.flight-row').length > 1) {
                        row.remove();
                    } else {
                        row.querySelectorAll(
                                'input[type="text"], input[type="date"], input[type="time"], input[type="number"]'
                            )
                            .forEach(el => el.value = '');
                        row.querySelectorAll('input[type="radio"]').forEach(el => el.checked = el.value ===
                            '0');
                    }
                }
            });
        })();

        // ---- Train repeatable rows ----
        (function() {
            let trainIndex = 1;

            document.getElementById('addTrainBtn').addEventListener('click', function() {
                const firstRow = document.querySelector('.train-row');
                const clone = firstRow.cloneNode(true);

                clone.querySelectorAll('input').forEach(function(el) {
                    el.name = el.name.replace(/trains\[\d+\]/, 'trains[' + trainIndex + ']');
                    el.value = '';
                });

                document.getElementById('trainRows').appendChild(clone);
                trainIndex++;
            });

            document.getElementById('trainRows').addEventListener('click', function(e) {
                if (e.target.closest('.remove-train-row')) {
                    const row = e.target.closest('.train-row');
                    if (document.querySelectorAll('.train-row').length > 1) {
                        row.remove();
                    } else {
                        row.querySelectorAll('input').forEach(el => el.value = '');
                    }
                }
            });
        })();
    </script>
@endsection