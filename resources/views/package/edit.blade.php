@extends('layout.master')

@section('title', 'Edit Package')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="py-3 d-flex align-items-center justify-content-between">
                    <h4 class="fs-18 fw-semibold m-0">Package / <strong>Edit</strong></h4>
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

                <form action="{{ route('package.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

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
                                        <input type="number" name="company_id" class="form-control"
                                            value="{{ old('company_id', $package->company_id) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Package #</label>
                                        <input type="text" name="package_number" class="form-control"
                                            value="{{ old('package_number', $package->package_number) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Category Zone</label>
                                        <input type="text" name="category_zone" class="form-control"
                                            value="{{ old('category_zone', $package->category_zone) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Nearby</label>
                                        <input type="text" name="nearby" class="form-control"
                                            value="{{ old('nearby', $package->nearby) }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Package Name *</label>
                                        <input type="text" name="name" class="form-control" required
                                            value="{{ old('name', $package->name) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Package Code</label>
                                        <input type="text" name="code" class="form-control"
                                            value="{{ old('code', $package->code) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Days</label>
                                        <input type="number" name="days" class="form-control"
                                            value="{{ old('days', $package->days) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Year</label>
                                        <input type="text" name="year" class="form-control"
                                            value="{{ old('year', $package->year) }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Travel Route</label>
                                        <select name="travel_route" class="form-select">
                                            <option value="">-- Select Route --</option>
                                            @foreach (\App\Enums\TravelRoute::options() as $val => $label)
                                                <option value="{{ $val }}" {{ old('travel_route', $package->travel_route) == $val ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <label class="form-label">Color</label>
                                        <input type="color" name="color" class="form-control form-control-color"
                                            value="{{ old('color', $package->color ?? '#000000') }}">
                                    </div> --}}
                                    <div class="col-md-4">
                                        <label class="form-label">Maktab *</label>
                                        <input type="text" name="maktab" class="form-control" required
                                            value="{{ old('maktab', $package->maktab) }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Maktab Number *</label>
                                        <input type="text" name="maktab_number" class="form-control" required
                                            value="{{ old('maktab_number', $package->maktab_number) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label d-block">Medina Arrival</label>
                                        @foreach (['before_hajj' => 'Before Hajj', 'after_hajj' => 'After Hajj'] as $val => $label)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="medina_arrival"
                                                    value="{{ $val }}"
                                                    {{ old('medina_arrival', $package->medina_arrival) == $val ? 'checked' : '' }}>
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
                                                    {{ old('hajj_duration', $package->hajj_duration) == $val ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $label }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Upload Package Image</label>
                                        <input type="file" name="image" class="form-control">
                                        @if ($package->image)
                                            <div class="mt-2">
                                                <img src="{{ asset('assets/images/packages/' . $package->image) }}"
                                                    height="60" class="rounded">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <hr class="my-4">
                                <h5 class="mb-3">Package Category</h5>
                                <div class="row g-3">
                                    @foreach (['pkr_roe' => 'PKR ROE', 'usd_roe' => 'USD ROE', 'gbp_roe' => 'GBP ROE', 'euro_roe' => 'EURO ROE', 'aed_roe' => 'AED ROE'] as $field => $label)
                                        <div class="col-md-2">
                                            <label class="form-label">{{ $label }}</label>
                                            <input type="number" step="0.01" name="{{ $field }}"
                                                class="form-control" value="{{ old($field, $package->$field) }}">
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-md-3">
                                        <label class="form-label">Room Type</label>
                                        <input type="text" name="room_type" class="form-control"
                                            value="{{ old('room_type', $package->room_type) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Azizia Room Type</label>
                                        <input type="text" name="azizia_room_type" class="form-control"
                                            value="{{ old('azizia_room_type', $package->azizia_room_type) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Makkah Type</label>
                                        <input type="text" name="makkah_type" class="form-control"
                                            value="{{ old('makkah_type', $package->makkah_type) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Medinah Type</label>
                                        <input type="text" name="medinah_type" class="form-control"
                                            value="{{ old('medinah_type', $package->medinah_type) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Azizia Type</label>
                                        <input type="text" name="azizia_type" class="form-control"
                                            value="{{ old('azizia_type', $package->azizia_type) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Mina Type</label>
                                        <input type="text" name="mina_type" class="form-control"
                                            value="{{ old('mina_type', $package->mina_type) }}">
                                    </div>
                                </div>

                                @foreach (['pkr' => 'PKR', 'sar' => 'SAR', 'usd' => 'USD', 'eur' => 'EUR', 'gbp' => 'GBP', 'aed' => 'AED'] as $cur => $label)
                                    <div class="row g-3 mt-1">
                                        <div class="col-md-4">
                                            <label class="form-label">Adult ({{ $label }})</label>
                                            <input type="number" step="0.01" name="adult_{{ $cur }}"
                                                class="form-control"
                                                value="{{ old("adult_{$cur}", $package->{"adult_{$cur}"}) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Child ({{ $label }})</label>
                                            <input type="number" step="0.01" name="child_{{ $cur }}"
                                                class="form-control"
                                                value="{{ old("child_{$cur}", $package->{"child_{$cur}"}) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Infant ({{ $label }})</label>
                                            <input type="number" step="0.01" name="infant_{{ $cur }}"
                                                class="form-control"
                                                value="{{ old("infant_{$cur}", $package->{"infant_{$cur}"}) }}">
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
                                    @forelse ($package->accommodations as $i => $row)
                                        <div class="accommodation-row border rounded p-3 mb-3 position-relative">
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger remove-accommodation-row position-absolute top-0 end-0 m-2"><i
                                                    class="mdi mdi-delete"></i></button>
                                            <div class="row g-3">
                                                <div class="col-md-3"><label class="form-label">Place *</label>
                                                    <select name="accommodations[{{ $i }}][place]" class="form-select">
                                                        <option value="">-- Select Place --</option>
                                                        @foreach (\App\Enums\Place::options() as $pVal => $pLabel)
                                                            <option value="{{ $pVal }}" {{ $row->place == $pVal ? 'selected' : '' }}>{{ $pLabel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3"><label class="form-label">Accommodation Type *</label>
                                                    <select name="accommodations[{{ $i }}][accommodation_type]" class="form-select">
                                                        <option value="">-- Select Type --</option>
                                                        @foreach (\App\Enums\AccommodationType::options() as $pVal => $pLabel)
                                                            <option value="{{ $pVal }}" {{ $row->accommodation_type == $pVal ? 'selected' : '' }}>{{ $pLabel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3"><label class="form-label">Saudi Star Rating *</label>
                                                    <select name="accommodations[{{ $i }}][saudi_star_rating]" class="form-select">
                                                        <option value="">-- Select Rating --</option>
                                                        @foreach (\App\Enums\SaudiStarRating::options() as $pVal => $pLabel)
                                                            <option value="{{ $pVal }}" {{ $row->saudi_star_rating == $pVal ? 'selected' : '' }}>{{ $pLabel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3"><label class="form-label">Hotel *</label>
                                                    <select name="accommodations[{{ $i }}][hotel]" class="form-select">
                                                        <option value="">-- Select Hotel --</option>
                                                        @foreach (\App\Enums\Hotel::options() as $pVal => $pLabel)
                                                            <option value="{{ $pVal }}" {{ $row->hotel == $pVal ? 'selected' : '' }}>{{ $pLabel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3"><label class="form-label">Distance
                                                        (meter)</label><input type="number"
                                                        name="accommodations[{{ $i }}][distance]"
                                                        class="form-control" value="{{ $row->distance }}"></div>
                                                <div class="col-md-3"><label class="form-label">Check In *</label><input
                                                        type="date"
                                                        name="accommodations[{{ $i }}][check_in]"
                                                        class="form-control"
                                                        value="{{ optional($row->check_in)->format('Y-m-d') }}"></div>
                                                <div class="col-md-3"><label class="form-label">Check Out *</label><input
                                                        type="date"
                                                        name="accommodations[{{ $i }}][check_out]"
                                                        class="form-control"
                                                        value="{{ optional($row->check_out)->format('Y-m-d') }}"></div>
                                                <div class="col-md-3"><label class="form-label">Food Package *</label>
                                                    <select name="accommodations[{{ $i }}][food_package]" class="form-select">
                                                        <option value="">-- Select Package --</option>
                                                        @foreach (\App\Enums\FoodPackage::options() as $pVal => $pLabel)
                                                            <option value="{{ $pVal }}" {{ $row->food_package == $pVal ? 'selected' : '' }}>{{ $pLabel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-4"><label class="form-label">Actual Hotel</label>
                                                    <select name="accommodations[{{ $i }}][actual_hotel]" class="form-select">
                                                        <option value="">-- Select Hotel --</option>
                                                        @foreach (\App\Enums\Hotel::options() as $pVal => $pLabel)
                                                            <option value="{{ $pVal }}" {{ $row->actual_hotel == $pVal ? 'selected' : '' }}>{{ $pLabel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4"><label class="form-label">Actual Check In
                                                        Time</label><input type="datetime-local"
                                                        name="accommodations[{{ $i }}][actual_check_in_time]"
                                                        class="form-control"
                                                        value="{{ optional($row->actual_check_in_time)->format('Y-m-d\TH:i') }}">
                                                </div>
                                                <div class="col-md-4"><label class="form-label">Actual Check Out
                                                        Time</label><input type="datetime-local"
                                                        name="accommodations[{{ $i }}][actual_check_out_time]"
                                                        class="form-control"
                                                        value="{{ optional($row->actual_check_out_time)->format('Y-m-d\TH:i') }}">
                                                </div>

                                                <div class="col-md-3"><label class="form-label">Days *</label><input
                                                        type="number" name="accommodations[{{ $i }}][days]"
                                                        class="form-control" value="{{ $row->days }}"></div>
                                                <div class="col-md-3"><label class="form-label">Nights *</label><input
                                                        type="number" name="accommodations[{{ $i }}][nights]"
                                                        class="form-control" value="{{ $row->nights }}"></div>
                                                <div class="col-md-3"><label class="form-label">Group Ziarat</label><input
                                                        type="text"
                                                        name="accommodations[{{ $i }}][group_ziarat]"
                                                        class="form-control" value="{{ $row->group_ziarat }}"></div>
                                                <div class="col-md-3"><label class="form-label">Religious
                                                        Lectures</label><input type="text"
                                                        name="accommodations[{{ $i }}][religious_lectures]"
                                                        class="form-control" value="{{ $row->religious_lectures }}">
                                                </div>

                                                <div class="col-md-4"><label class="form-label">Distribution</label><input
                                                        type="text"
                                                        name="accommodations[{{ $i }}][distribution]"
                                                        class="form-control" value="{{ $row->distribution }}"></div>
                                                <div class="col-md-4"><label class="form-label">Camp</label><input
                                                        type="text" name="accommodations[{{ $i }}][camp]"
                                                        class="form-control" value="{{ $row->camp }}"></div>
                                                <div class="col-md-4"><label class="form-label">Arafat</label><input
                                                        type="text" name="accommodations[{{ $i }}][arafat]"
                                                        class="form-control" value="{{ $row->arafat }}"></div>

                                                <div class="col-md-4"><label class="form-label">Shuttle</label><input
                                                        type="text"
                                                        name="accommodations[{{ $i }}][shuttle]"
                                                        class="form-control" value="{{ $row->shuttle }}"></div>
                                                <div class="col-md-4"><label class="form-label">Bedding (Sofa
                                                        Mattress)</label><input type="text"
                                                        name="accommodations[{{ $i }}][bedding]"
                                                        class="form-control" value="{{ $row->bedding }}"></div>
                                                <div class="col-md-4"><label class="form-label">Sharing (Room / Tent /
                                                        Camp)</label><input type="text"
                                                        name="accommodations[{{ $i }}][sharing]"
                                                        class="form-control" value="{{ $row->sharing }}"></div>

                                                <div class="col-md-4"><label class="form-label">Sharing Type</label><input
                                                        type="text"
                                                        name="accommodations[{{ $i }}][sharing_type]"
                                                        class="form-control" value="{{ $row->sharing_type }}"></div>
                                                <div class="col-md-8"><label class="form-label">Note</label><input
                                                        type="text" name="accommodations[{{ $i }}][note]"
                                                        class="form-control" value="{{ $row->note }}"></div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="accommodation-row border rounded p-3 mb-3 position-relative">
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger remove-accommodation-row position-absolute top-0 end-0 m-2"><i
                                                    class="mdi mdi-delete"></i></button>
                                            <div class="row g-3">
                                                <div class="col-md-3"><label class="form-label">Place *</label>
                                                    <select name="accommodations[0][place]" class="form-select">
                                                        <option value="">-- Select Place --</option>
                                                        @foreach (\App\Enums\Place::options() as $pVal => $pLabel)
                                                            <option value="{{ $pVal }}">{{ $pLabel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3"><label class="form-label">Accommodation Type *</label>
                                                    <select name="accommodations[0][accommodation_type]" class="form-select">
                                                        <option value="">-- Select Type --</option>
                                                        @foreach (\App\Enums\AccommodationType::options() as $pVal => $pLabel)
                                                            <option value="{{ $pVal }}">{{ $pLabel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3"><label class="form-label">Saudi Star Rating *</label>
                                                    <select name="accommodations[0][saudi_star_rating]" class="form-select">
                                                        <option value="">-- Select Rating --</option>
                                                        @foreach (\App\Enums\SaudiStarRating::options() as $pVal => $pLabel)
                                                            <option value="{{ $pVal }}">{{ $pLabel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3"><label class="form-label">Hotel *</label>
                                                    <select name="accommodations[0][hotel]" class="form-select">
                                                        <option value="">-- Select Hotel --</option>
                                                        @foreach (\App\Enums\Hotel::options() as $pVal => $pLabel)
                                                            <option value="{{ $pVal }}">{{ $pLabel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3"><label class="form-label">Distance
                                                        (meter)</label><input type="number"
                                                        name="accommodations[0][distance]" class="form-control"></div>
                                                <div class="col-md-3"><label class="form-label">Check In *</label><input
                                                        type="date" name="accommodations[0][check_in]"
                                                        class="form-control"></div>
                                                <div class="col-md-3"><label class="form-label">Check Out *</label><input
                                                        type="date" name="accommodations[0][check_out]"
                                                        class="form-control"></div>
                                                <div class="col-md-3"><label class="form-label">Food Package *</label>
                                                    <select name="accommodations[0][food_package]" class="form-select">
                                                        <option value="">-- Select Package --</option>
                                                        @foreach (\App\Enums\FoodPackage::options() as $pVal => $pLabel)
                                                            <option value="{{ $pVal }}">{{ $pLabel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-4"><label class="form-label">Actual Hotel</label>
                                                    <select name="accommodations[0][actual_hotel]" class="form-select">
                                                        <option value="">-- Select Hotel --</option>
                                                        @foreach (\App\Enums\Hotel::options() as $pVal => $pLabel)
                                                            <option value="{{ $pVal }}">{{ $pLabel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4"><label class="form-label">Actual Check In
                                                        Time</label><input type="datetime-local"
                                                        name="accommodations[0][actual_check_in_time]"
                                                        class="form-control"></div>
                                                <div class="col-md-4"><label class="form-label">Actual Check Out
                                                        Time</label><input type="datetime-local"
                                                        name="accommodations[0][actual_check_out_time]"
                                                        class="form-control"></div>

                                                <div class="col-md-3"><label class="form-label">Days *</label><input
                                                        type="number" name="accommodations[0][days]"
                                                        class="form-control"></div>
                                                <div class="col-md-3"><label class="form-label">Nights *</label><input
                                                        type="number" name="accommodations[0][nights]"
                                                        class="form-control"></div>
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
                                                        type="text" name="accommodations[0][camp]"
                                                        class="form-control"></div>
                                                <div class="col-md-4"><label class="form-label">Arafat</label><input
                                                        type="text" name="accommodations[0][arafat]"
                                                        class="form-control"></div>

                                                <div class="col-md-4"><label class="form-label">Shuttle</label><input
                                                        type="text" name="accommodations[0][shuttle]"
                                                        class="form-control"></div>
                                                <div class="col-md-4"><label class="form-label">Bedding (Sofa
                                                        Mattress)</label><input type="text"
                                                        name="accommodations[0][bedding]" class="form-control"></div>
                                                <div class="col-md-4"><label class="form-label">Sharing (Room / Tent /
                                                        Camp)</label><input type="text"
                                                        name="accommodations[0][sharing]" class="form-control"></div>

                                                <div class="col-md-4"><label class="form-label">Sharing Type</label><input
                                                        type="text" name="accommodations[0][sharing_type]"
                                                        class="form-control"></div>
                                                <div class="col-md-8"><label class="form-label">Note</label><input
                                                        type="text" name="accommodations[0][note]"
                                                        class="form-control"></div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- ================= TRANSPORT ================= --}}
                        <div class="tab-pane fade card" id="tab-transport">
                            <div class="card-body">
                                <h5 class="mb-3">Transport Details</h5>
                                <textarea name="transport_details" rows="6" class="form-control" placeholder="Enter transport details...">{{ old('transport_details', $package->transport->details ?? '') }}</textarea>
                            </div>
                        </div>

                        {{-- ================= TRAINING / GIFTS ================= --}}
                        <div class="tab-pane fade card" id="tab-training">
                            <div class="card-body">
                                <h5 class="mb-3">Training Session</h5>
                                @if($trainingSessions->isEmpty())
                                    <p class="text-danger mb-3">No Training Sessions Exists! <a href="{{ route('training-session.create') }}" target="_blank">Please create training sessions first</a></p>
                                @else
                                    @php $selectedSessions = old('training_sessions', $package->trainingSessions->pluck('id')->toArray() ?? []); @endphp
                                    @foreach ($trainingSessions as $session)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="training_sessions[]"
                                                value="{{ $session->id }}" id="session-{{ $session->id }}"
                                                {{ in_array($session->id, $selectedSessions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="session-{{ $session->id }}">
                                                {{ $session->name }}
                                                @if($session->session_date)
                                                    ({{ \Carbon\Carbon::parse($session->session_date)->format('d M, Y') }} at {{ $session->session_time ? \Carbon\Carbon::parse($session->session_time)->format('h:i A') : '' }})
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                @endif

                                <h5 class="mb-3 mt-4">Giveaways</h5>
                                @php $selectedGiveaways = old('giveaways', $package->giveaways->pluck('id')->toArray()); @endphp
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
                                <textarea name="terms_content" rows="8" class="form-control" placeholder="Write your content here...">{{ old('terms_content', $package->terms->content ?? '') }}</textarea>
                            </div>
                        </div>

                        {{-- ================= ITINERARY ================= --}}
                        <div class="tab-pane fade card" id="tab-itinerary">
                            <div class="card-body">
                                <h5 class="mb-3">Description</h5>
                                <textarea name="itinerary_description" rows="8" class="form-control mb-4"
                                    placeholder="Write your content here...">{{ old('itinerary_description', $package->itinerary->description ?? '') }}</textarea>

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
                                            @if (!empty($package->itinerary->$field ?? null))
                                                <div class="mt-2">
                                                    <img src="{{ asset('assets/images/packages/itinerary/' . $package->itinerary->$field) }}"
                                                        height="60" class="rounded">
                                                </div>
                                            @endif
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
                                            value="{{ old('maktab_address', $package->maktabAddress->maktab_address ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Office Address *</label>
                                        <input type="text" name="office_address" class="form-control" required
                                            value="{{ old('office_address', $package->maktabAddress->office_address ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end" style="margin: 20px">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            let accIndex = {{ max(1, $package->accommodations->count()) }};

            document.getElementById('addAccommodationBtn').addEventListener('click', function() {
                const firstRow = document.querySelector('.accommodation-row');
                const clone = firstRow.cloneNode(true);

                clone.querySelectorAll('input, textarea, select').forEach(function(el) {
                    el.name = el.name.replace(/accommodations\[\d+\]/, 'accommodations[' + accIndex + ']');
                    if (el.tagName === 'SELECT') { el.selectedIndex = 0; }
                    else if (el.type !== 'button') { el.value = ''; }
                });
                clone.querySelectorAll('img').forEach(el => el.remove());

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
    </script>
@endpush
