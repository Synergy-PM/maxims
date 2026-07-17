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

                    <div class="tab-content">

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
                                        <input type="text" name="package_number" class="form-control"
                                            value="{{ old('package_number') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Category Zone</label>
                                        <input type="text" name="category_zone" class="form-control"
                                            value="{{ old('category_zone') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Nearby</label>
                                        <input type="text" name="nearby" class="form-control"
                                            value="{{ old('nearby') }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Package Name *</label>
                                        <input type="text" name="name" class="form-control" required
                                            value="{{ old('name') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Package Code</label>
                                        <input type="text" name="code" class="form-control"
                                            value="{{ old('code') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Days</label>
                                        <input type="number" name="days" class="form-control"
                                            value="{{ old('days') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Year</label>
                                        <input type="text" name="year" class="form-control"
                                            value="{{ old('year', date('Y') + 1) }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Travel Route</label>
                                        <select name="travel_route" class="form-select">
                                            <option value="">-- Select Route --</option>
                                            @foreach (\App\Enums\TravelRoute::options() as $val => $label)
                                                <option value="{{ $val }}"
                                                    {{ old('travel_route') == $val ? 'selected' : '' }}>
                                                    {{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <label class="form-label">Color</label>
                                        <input type="color" name="color" class="form-control form-control-color"
                                            value="{{ old('color', '#000000') }}">
                                    </div> --}}
                                    <div class="col-md-4">
                                        <label class="form-label">Maktab *</label>
                                        <input type="text" name="maktab" class="form-control" required
                                            value="{{ old('maktab') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Maktab Number *</label>
                                        <input type="text" name="maktab_number" class="form-control" required
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

                                    <div class="col-md-6">
                                        <label class="form-label">Upload Package Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>

                                <hr class="my-4">
                                <h5 class="mb-3">Package Category</h5>
                                <div class="row g-3">
                                    @foreach (['pkr_roe' => 'PKR ROE', 'usd_roe' => 'USD ROE', 'gbp_roe' => 'GBP ROE', 'euro_roe' => 'EURO ROE', 'aed_roe' => 'AED ROE'] as $field => $label)
                                        <div class="col-md-2">
                                            <label class="form-label">{{ $label }}</label>
                                            <input type="number" step="0.01" name="{{ $field }}"
                                                class="form-control" value="{{ old($field, 0) }}">
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-md-3">
                                        <label class="form-label">Room Type</label>
                                        <input type="text" name="room_type" class="form-control"
                                            value="{{ old('room_type') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Azizia Room Type</label>
                                        <input type="text" name="azizia_room_type" class="form-control"
                                            value="{{ old('azizia_room_type') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Makkah Type</label>
                                        <input type="text" name="makkah_type" class="form-control"
                                            value="{{ old('makkah_type') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Medinah Type</label>
                                        <input type="text" name="medinah_type" class="form-control"
                                            value="{{ old('medinah_type') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Azizia Type</label>
                                        <input type="text" name="azizia_type" class="form-control"
                                            value="{{ old('azizia_type') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Mina Type</label>
                                        <input type="text" name="mina_type" class="form-control"
                                            value="{{ old('mina_type') }}">
                                    </div>
                                </div>

                                @foreach (['pkr' => 'PKR', 'sar' => 'SAR', 'usd' => 'USD', 'eur' => 'EUR', 'gbp' => 'GBP', 'aed' => 'AED'] as $cur => $label)
                                    <div class="row g-3 mt-1">
                                        <div class="col-md-4">
                                            <label class="form-label">Adult ({{ $label }})</label>
                                            <input type="number" step="0.01" name="adult_{{ $cur }}"
                                                class="form-control" value="{{ old("adult_{$cur}", 0) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Child ({{ $label }})</label>
                                            <input type="number" step="0.01" name="child_{{ $cur }}"
                                                class="form-control" value="{{ old("child_{$cur}", 0) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Infant ({{ $label }})</label>
                                            <input type="number" step="0.01" name="infant_{{ $cur }}"
                                                class="form-control" value="{{ old("infant_{$cur}", 0) }}">
                                        </div>
                                    </div>
                                @endforeach
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
                                            <div class="col-md-3"><label class="form-label">Place *</label>
                                                <select name="accommodations[0][place]" class="form-select">
                                                    <option value="">-- Select Place --</option>
                                                    @foreach (\App\Enums\Place::options() as $val => $label)
                                                        <option value="{{ $val }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Accommodation Type *</label>
                                                <select name="accommodations[0][accommodation_type]" class="form-select">
                                                    <option value="">-- Select Type --</option>
                                                    @foreach (\App\Enums\AccommodationType::options() as $val => $label)
                                                        <option value="{{ $val }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Saudi Star Rating *</label>
                                                <select name="accommodations[0][saudi_star_rating]" class="form-select">
                                                    <option value="">-- Select Rating --</option>
                                                    @foreach (\App\Enums\SaudiStarRating::options() as $val => $label)
                                                        <option value="{{ $val }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Hotel *</label>
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
                                            <div class="col-md-3"><label class="form-label">Check In *</label><input
                                                    type="date" name="accommodations[0][check_in]"
                                                    class="form-control"></div>
                                            <div class="col-md-3"><label class="form-label">Check Out *</label><input
                                                    type="date" name="accommodations[0][check_out]"
                                                    class="form-control"></div>
                                            <div class="col-md-3"><label class="form-label">Food Package *</label>
                                                <select name="accommodations[0][food_package]" class="form-select">
                                                    <option value="">-- Select Package --</option>
                                                    @foreach (\App\Enums\FoodPackage::options() as $val => $label)
                                                        <option value="{{ $val }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4"><label class="form-label">Actual Hotel</label>
                                                <select name="accommodations[0][actual_hotel]" class="form-select">
                                                    <option value="">-- Select Hotel --</option>
                                                    @foreach (\App\Enums\Hotel::options() as $val => $label)
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

                                            <div class="col-md-3"><label class="form-label">Days *</label><input
                                                    type="number" name="accommodations[0][days]" class="form-control">
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Nights *</label><input
                                                    type="number" name="accommodations[0][nights]" class="form-control">
                                            </div>
                                            <div class="col-md-3"><label class="form-label">Group Ziarat</label><input
                                                    type="text" name="accommodations[0][group_ziarat]"
                                                    class="form-control"></div>
                                            <div class="col-md-3"><label class="form-label">Religious
                                                    Lectures</label><input type="text"
                                                    name="accommodations[0][religious_lectures]" class="form-control">
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

                                            <div class="col-md-4"><label class="form-label">Shuttle</label><input
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

                                {{-- ---- General Route ---- --}}
                                <h5 class="mb-3">Transport Details</h5>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-3">
                                        <label class="form-label">Route</label>
                                        <input type="text" name="transport_route" class="form-control"
                                            value="{{ old('transport_route') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Arrival</label>
                                        <input type="text" name="transport_arrival" class="form-control"
                                            value="{{ old('transport_arrival') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Departure</label>
                                        <input type="text" name="transport_departure" class="form-control"
                                            value="{{ old('transport_departure') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Type</label>
                                        <input type="text" name="transport_type" class="form-control"
                                            value="{{ old('transport_type') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Vehicle</label>
                                        <input type="text" name="transport_vehicle" class="form-control"
                                            value="{{ old('transport_vehicle') }}">
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
                                @foreach ($giveaways as $g)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="giveaways[]"
                                            value="{{ $g->id }}" id="giveaway-{{ $g->id }}"
                                            {{ in_array($g->id, $selectedGiveaways) ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="giveaway-{{ $g->id }}">{{ $g->code }} -
                                            {{ $g->name }}</label>
                                    </div>
                                @endforeach
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
                                        <label class="form-label">Maktab Address *</label>
                                        <input type="text" name="maktab_address" class="form-control" required
                                            value="{{ old('maktab_address') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Office Address *</label>
                                        <input type="text" name="office_address" class="form-control" required
                                            value="{{ old('office_address') }}">
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-success">Create</button>
                                </div>
                            </div>
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
