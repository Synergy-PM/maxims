@php
    $isEdit = $package->exists;
    $acc = old('accommodations', $package->accommodations ?? []);
    $accommodations = collect($acc);
@endphp

<form action="{{ $isEdit ? route('package.update', $package->id) : route('package.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <ul class="nav nav-pills mb-3" id="packageTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab-package" type="button">
                📦 PACKAGE
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-accommodation" type="button">
                🛏 ACCOMMODATION
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-transport" type="button">
                🚌 TRANSPORT
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-training" type="button">
                🎁 TRAINING / GIFTS
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-terms" type="button">
                ⚙ TERMS & CONDITION
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-itinerary" type="button">
                🕋 ITINERARY
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-maktab" type="button">
                🏠 MAKTAB ADDRESS
            </button>
        </li>
    </ul>

    <div class="tab-content">

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
                            value="{{ old('year', $package->year ?? date('Y') + 1) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Travel Route</label>
                        <input type="text" name="travel_route" class="form-control"
                            value="{{ old('travel_route', $package->travel_route) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Color</label>
                        <input type="color" name="color" class="form-control form-control-color"
                            value="{{ old('color', $package->color ?? '#000000') }}">
                    </div>
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
                                    {{ old('medina_arrival', $package->medina_arrival ?? 'before_hajj') == $val ? 'checked' : '' }}>
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
                                    {{ old('hajj_duration', $package->hajj_duration ?? 'short') == $val ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Upload Package Image</label>
                        <input type="file" name="image" class="form-control">
                        @if (!empty($package->image))
                            <small class="text-muted">Current: {{ $package->image }}</small>
                        @endif
                    </div>
                </div>

                <hr class="my-4">
                <h5 class="mb-3">Package Category</h5>
                <div class="row g-3">
                    @foreach (['pkr_roe' => 'PKR ROE', 'usd_roe' => 'USD ROE', 'gbp_roe' => 'GBP ROE', 'euro_roe' => 'EURO ROE', 'aed_roe' => 'AED ROE'] as $field => $label)
                        <div class="col-md-2">
                            <label class="form-label">{{ $label }}</label>
                            <input type="number" step="0.01" name="{{ $field }}" class="form-control"
                                value="{{ old($field, $package->$field ?? 0) }}">
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
                                value="{{ old("adult_{$cur}", $package->{"adult_{$cur}"} ?? 0) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Child ({{ $label }})</label>
                            <input type="number" step="0.01" name="child_{{ $cur }}"
                                class="form-control"
                                value="{{ old("child_{$cur}", $package->{"child_{$cur}"} ?? 0) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Infant ({{ $label }})</label>
                            <input type="number" step="0.01" name="infant_{{ $cur }}"
                                class="form-control"
                                value="{{ old("infant_{$cur}", $package->{"infant_{$cur}"} ?? 0) }}">
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
                    <button type="button" class="btn btn-outline-primary btn-sm" id="addAccommodationBtn">
                        Add <i class="mdi mdi-plus"></i>
                    </button>
                </div>

                <div id="accommodationRows">
                    @forelse ($accommodations as $i => $row)
                        @include('package._accommodation_row', ['i' => $i, 'row' => (object) $row])
                    @empty
                        @include('package._accommodation_row', ['i' => 0, 'row' => (object) []])
                    @endforelse
                </div>

                <template id="accommodationRowTemplate">
                    @include('package._accommodation_row', ['i' => '__INDEX__', 'row' => (object) []])
                </template>
            </div>
        </div>

        {{-- ================= TRANSPORT ================= --}}
        <div class="tab-pane fade card" id="tab-transport">
            <div class="card-body">
                <h5 class="mb-3">Transport Details</h5>
                {{-- Transport tab fields weren't visible in the shared screenshots.
                     Swap this textarea for real fields once you share that tab's UI. --}}
                <textarea name="transport_details" rows="6" class="form-control" placeholder="Enter transport details...">{{ old('transport_details', $package->transport->details ?? '') }}</textarea>
            </div>
        </div>

        {{-- ================= TRAINING / GIFTS ================= --}}
        <div class="tab-pane fade card" id="tab-training">
            <div class="card-body">
                <h5 class="mb-3">Training Session</h5>
                <p class="text-danger mb-3">No Training Sessions Exists! <a href="#">Please create training
                        sessions first</a></p>

                <h5 class="mb-3">Giveaways</h5>
                @php $selectedGiveaways = old('giveaways', $package->giveaways->pluck('id')->toArray() ?? []); @endphp
                @foreach ($giveaways as $g)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="giveaways[]"
                            value="{{ $g->id }}" id="giveaway-{{ $g->id }}"
                            {{ in_array($g->id, $selectedGiveaways) ? 'checked' : '' }}>
                        <label class="form-check-label" for="giveaway-{{ $g->id }}">
                            {{ $g->code }} - {{ $g->name }}
                        </label>
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
                                <small class="text-muted">Current: {{ $package->itinerary->$field }}</small>
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

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success">
                        {{ $isEdit ? 'Update' : 'Create' }}
                    </button>
                </div>
            </div>
        </div>

    </div>
</form>

@push('scripts')
    <script>
        (function() {
            let accIndex = {{ max(1, $accommodations->count()) }};

            document.getElementById('addAccommodationBtn').addEventListener('click', function() {
                const template = document.getElementById('accommodationRowTemplate').innerHTML;
                const html = template.replaceAll('__INDEX__', accIndex);
                document.getElementById('accommodationRows').insertAdjacentHTML('beforeend', html);
                accIndex++;
            });

            document.getElementById('accommodationRows').addEventListener('click', function(e) {
                if (e.target.closest('.remove-accommodation-row')) {
                    const row = e.target.closest('.accommodation-row');
                    if (document.querySelectorAll('.accommodation-row').length > 1) {
                        row.remove();
                    } else {
                        row.querySelectorAll('input, textarea').forEach(el => el.value = '');
                    }
                }
            });
        })();
    </script>
@endpush
