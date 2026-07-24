<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Executive Platinum - {{ $package->days ?? '14' }} Days Package</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- html2pdf.js Library for PDF Generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
        :root {
            --navy: #1b1f4b;
            --gold: #d9a441;
            --gold-dark: #c8922e;
            --peach: #f3cfa0;
            --peach-light: #f8e4c3;
            --grey-row: #e9e9e9;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f0f0;
            color: #1b1f4b;
            padding-top: 10px;
        }

        /* Top Action Bar for Download Button */
        .action-bar {
            max-width: 1050px;
            margin: 0 auto 10px auto;
            display: flex;
            justify-content: flex-end;
            padding: 0 10px;
        }

        .btn-download {
            background-color: var(--gold);
            color: var(--navy);
            font-weight: 700;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-download:hover {
            background-color: var(--gold-dark);
            color: #fff;
        }

        /* Optimized for absolute 1-page printing */
        .sheet {
            max-width: 1050px;
            margin: 0 auto;
            background: #fff;
            padding: 15px 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, .15);
            box-sizing: border-box;
        }

        .header-banner {
            display: flex;
            align-items: stretch;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 12px;
        }

        .header-left {
            background: var(--navy);
            color: var(--gold);
            padding: 15px 20px;
            flex: 2;
        }

        .header-left h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            font-size: 2.2rem;
            margin: 0;
            letter-spacing: 1px;
            line-height: 1;
        }

        .header-left .subtitle {
            color: #fff;
            font-weight: 600;
            font-size: .85rem;
            letter-spacing: 1px;
            margin-top: 5px;
        }

        .header-right {
            background: linear-gradient(135deg, var(--gold-dark), var(--gold) 40%, #b9812a);
            color: var(--navy);
            flex: 1.6;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 5px 15px;
            flex-wrap: wrap;
        }

        .pkg-code-box {
            text-align: center;
            font-weight: 800;
            line-height: 1.1;
        }

        .pkg-code-box .lbl {
            font-size: .65rem;
            letter-spacing: 1px;
        }

        .pkg-code-box .code {
            font-size: 1.1rem;
            background: var(--navy);
            color: #fff;
            padding: 2px 8px;
            border-radius: 3px;
        }

        .header-right .days {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-weight: 700;
            font-size: 2rem;
            color: var(--navy);
        }

        .tags-row {
            display: flex;
            gap: 6px;
            margin-top: 4px;
            width: 100%;
        }

        .tag-badge {
            background: var(--navy);
            color: #fff;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .5px;
            padding: 3px 8px;
            border-radius: 3px;
        }

        .pkg-table {
            border-collapse: collapse;
            width: 100%;
            font-size: .8rem;
        }

        .pkg-table th,
        .pkg-table td {
            border: 1px solid #333;
            text-align: center;
            vertical-align: middle;
            padding: 5px 6px;
        }

        .pkg-table thead th {
            background: var(--navy);
            color: #fff;
            font-weight: 700;
        }

        .pkg-table tbody tr:nth-child(odd) {
            background: var(--grey-row);
        }

        .pkg-table tbody tr:nth-child(even) {
            background: #fff;
        }

        .note-strip {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
            flex-wrap: wrap;
        }

        .ticket-note {
            font-weight: 700;
            font-size: 0.9rem;
        }

        .note-box {
            background: var(--navy);
            color: #fff;
            font-size: .75rem;
            padding: 6px 12px;
            border-radius: 2px;
            flex: 1;
            text-align: center;
        }

        .note-box b {
            background: #fff;
            color: var(--navy);
            padding: 1px 6px;
            margin-right: 6px;
            border-radius: 2px;
        }

        .room-type-strip {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 10px 0;
        }

        .room-type-pill {
            background: var(--peach-light);
            border: 1px solid var(--gold);
            color: var(--navy);
            font-size: .72rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .room-type-pill .k {
            font-weight: 800;
            letter-spacing: .3px;
        }

        .room-type-pill .v {
            background: var(--navy);
            color: #fff;
            padding: 1px 8px;
            border-radius: 12px;
            font-weight: 600;
        }

        .room-table-wrap {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .12);
            margin-bottom: 8px;
        }

        .room-table {
            border-collapse: collapse;
            width: 100%;
            font-size: .8rem;
            margin-bottom: 0;
        }

        .room-table td,
        .room-table th {
            border: 1px solid #ddd;
            padding: 7px 8px;
            text-align: center;
        }

        .room-table .room-header {
            background: var(--navy);
            color: var(--gold);
            font-weight: 800;
            width: 18%;
            border-color: var(--navy);
        }

        .room-table thead th {
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            color: var(--navy);
            font-weight: 800;
            letter-spacing: .5px;
            border-color: var(--gold-dark);
        }

        .room-table tbody tr:nth-child(odd) td:not(.room-header) {
            background: var(--grey-row);
        }

        .room-table tbody tr:hover td:not(.room-header) {
            background: var(--peach-light);
        }

        .price-caption {
            text-align: right;
            font-weight: 700;
            font-size: 0.78rem;
            margin: 4px 0 10px;
        }

        .notes-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            font-size: 1.2rem;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .notes-list {
            font-size: .78rem;
            line-height: 1.4;
        }

        .notes-list li {
            margin-bottom: 6px;
        }

        .icon-box {
            border: 2px solid var(--gold);
            border-radius: 12px;
            padding: 12px;
        }

        .icon-item {
            text-align: center;
            margin-bottom: 8px;
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--navy);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 4px;
            font-size: 1.2rem;
        }

        .icon-item .label {
            font-weight: 800;
            font-size: .75rem;
            letter-spacing: .5px;
        }

        .icon-item .desc {
            font-size: .65rem;
            color: #555;
            line-height: 1.2;
        }

        .zone-badge {
            background: var(--navy);
            color: var(--gold);
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-block;
            font-size: .8rem;
            letter-spacing: 1px;
        }

        .zone-badge small {
            display: block;
            color: #fff;
            font-size: .55rem;
            font-weight: 600;
        }

        .taxi-strip {
            background: var(--navy);
            color: #fff;
            font-size: .7rem;
            text-align: center;
            padding: 6px;
            font-weight: 600;
            margin-bottom: 4px;
            border-radius: 2px;
        }
    </style>
</head>

<body>

    <!-- Top Area for Download Button -->
    <div class="action-bar">
        <button class="btn-download" onclick="downloadPackagePDF()">📥 Download PDF</button>
    </div>

    <!-- Main Content Sheet -->
    <div class="sheet" id="packageSheet">
        <div class="header-banner">
            <div class="header-left">
                <h1>{{ $package->name }}</h1>
                <div class="subtitle">{{ $package->travel_route ?? 'Route Info' }}</div>
            </div>
            <div class="header-right">
                <div class="pkg-code-box">
                    <div class="lbl">PKG CODE</div>
                    <div class="code">{{ $package->code ?? 'N/A' }}</div>
                </div>
                <div class="days">{{ $package->days ?? '0' }} Days Package</div>
                <div class="tags-row justify-content-end">
                    <span class="tag-badge">{{ str_replace('_', ' ', $package->medina_arrival ?? '') }}</span>
                    <!-- Fixed: Used strtoupper() instead of undefined uppercase() helper -->
                    <span class="tag-badge">{{ strtoupper($package->hajj_duration ?? '') }} HAJJ</span>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="pkg-table">
                <thead>
                    <tr>
                        <th>PLACE</th>
                        <th>ACCOMMODATION TYPE</th>
                        <th>HOTEL</th>
                        <th>RATING</th>
                        <th>AZIZIA DATE</th>
                        <th>FOOD PACKAGE</th>
                        <th>SHUTTLE</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Fixed: Calling accommodations dynamic relation from $package model -->
                    @forelse(($package->accommodations ?? []) as $acc)
                        <tr>
                            <td>{{ $acc['place'] ?? ($acc->place ?? '-') }}</td>
                            <td>{{ $acc['accommodation_type'] ?? ($acc->accommodation_type ?? '-') }}</td>
                            <td>{{ $acc['hotel'] ?? ($acc->hotel ?? '-') }}</td>
                            <td>
                                @php
                                    $rating = $acc['saudi_star_rating'] ?? ($acc->saudi_star_rating ?? null);
                                @endphp
                                @if (!empty($rating))
                                    <span class="stars">
                                        @for ($i = 0; $i < intval($rating); $i++)
                                            ★
                                        @endfor
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @php
                                    $aziziaDate = $acc['azizia_date'] ?? ($acc->azizia_date ?? null);
                                @endphp
                                @if (!empty($aziziaDate))
                                    {{ \Carbon\Carbon::parse($aziziaDate)->format('d M, Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $acc['food_package'] ?? ($acc->food_package ?? '-') }}</td>
                            <td>{{ $acc['shuttle'] ?? ($acc->shuttle ?? '-') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No Accommodation details provided.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="note-strip">
            <div class="ticket-note">Ticket &amp; Qurbani not Included</div>
            <div class="note-box">
                <b>NOTE:</b> MAKKAH HOTEL ROOMS WILL BE RETAINED FROM 08 ZIL HAJJ TO 12 ZIL HAJJ.
            </div>
        </div>

        <!-- Room Type Info Strip -->
        <div class="room-type-strip">
            @foreach ([
        'room_type' => 'ROOM TYPE',
        'azizia_room_type' => 'AZIZIA ROOM TYPE',
        'makkah_type' => 'MAKKAH TYPE',
        'medinah_type' => 'MEDINAH TYPE',
        'azizia_type' => 'AZIZIA TYPE',
        'mina_type' => 'MINA TYPE',
    ] as $field => $label)
                @if (!empty($package->{$field}))
                    <span class="room-type-pill">
                        <span class="k">{{ $label }}</span>
                        <span class="v">{{ $package->{$field} }}</span>
                    </span>
                @endif
            @endforeach
        </div>

        <!-- Makkah / Madinah Sharing Breakdown Table (replaces old SAR/PKR price table) -->
        <div class="table-responsive room-table-wrap">
            <table class="room-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>DOUBLE</th>
                        <th>TRIPLE</th>
                        <th>QUAD</th>
                        <th>SHARING</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([
        'makkah_a' => 'MAKKAH A',
        'makkah_b' => 'MAKKAH B',
        'madinah_a' => 'MADINAH A',
        'madinah_b' => 'MADINAH B',
    ] as $field => $label)
                        @php
                            $row = $package->{$field} ?? [];
                            if (is_string($row)) {
                                $row = json_decode($row, true) ?? [];
                            }
                        @endphp
                        <tr>
                            <td class="room-header">{{ $label }}</td>
                            <td>{{ $row['double'] ?? '-' }}</td>
                            <td>{{ $row['triple'] ?? '-' }}</td>
                            <td>{{ $row['quad'] ?? '-' }}</td>
                            <td>{{ $row['sharing'] ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-lg-5 mb-2">
                <div class="icon-box">
                    <div class="row">
                        <div class="col-6 icon-item">
                            <div class="text-center mb-2">
                                <span class="zone-badge">ZONE {{ $package->category_zone ?? '1' }}<small>MAKTAB
                                        {{ $package->maktab ?? 'A-CATEGORY' }}</small></span>
                            </div>
                            <div class="label">BEST LOCATION IN MINA</div>
                            <div class="desc">AVG 16 PEOPLE TO A TENT<br>SOFA CUM BED SIZE 50-55 CM EACH</div>
                        </div>
                        <div class="col-6 icon-item">
                            <div class="icon-circle">🍽️</div>
                            <div class="label">MAKKAH &amp; MEDINAH</div>
                            <div class="desc">HALF BOARD BASIS</div>
                        </div>
                        <div class="col-6 icon-item">
                            <div class="icon-circle">🍽️</div>
                            <div class="label">FULL BOARD BUFFET</div>
                            <div class="desc">MEAL IN MINA &amp; ARAFAT</div>
                        </div>
                        <div class="col-6 icon-item">
                            <div class="icon-circle">🛁</div>
                            <div class="label">PRIVATE BATHROOM</div>
                            <div class="desc">IN MINA &amp; ARAFAT</div>
                        </div>
                        <div class="col-12 icon-item mb-0">
                            <div class="icon-circle">🚄</div>
                            <div class="label">BULLET TRAIN / LUXURY BUS</div>
                            <div class="desc">MODEL 2025/2026 WITH BATHROOM</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 mb-2">
                <div class="notes-title">NOTES:</div>
                <ul class="notes-list ps-3">
                    @if (!empty($terms['terms_content']))
                        <li>{!! nl2br(e($terms['terms_content'])) !!}</li>
                    @else
                        <li><b>Upgrade your Hajj from Platinum to Deluxe Hajj</b> with Supplement SAR 16,000 Per Person
                            (Private Toilet, 8 People tent).</li>
                        <li><b>Upgrade your Hajj from Platinum to Diamond Hajj</b> with Supplement SAR 6,000 Per Person
                            (12 People tent).</li>
                        <li>Family Rooms available in Aziziya Building during 5 days of Hajj with Supplement SAR 20,000.
                        </li>
                    @endif
                </ul>
                <div class="taxi-strip">FAMILY CAR SERVICES AVAILABLE SAR 600 PER PERSON FROM JEDDAH AIRPORT TO MAKKAH
                    &amp; V.V</div>
                <div class="taxi-strip">FAMILY CAR SERVICES AVAILABLE SAR 150 PER PERSON FROM MEDINAH AIRPORT TO MEDINAH
                    &amp; V.V</div>
            </div>
        </div>
    </div>

    <!-- Script to Generate/Download PDF -->
    <script>
        function downloadPackagePDF() {
            const element = document.getElementById('packageSheet');
            const options = {
                margin: [5, 5, 5, 5],
                filename: '{{ $package->code ?? 'Package' }}_14_Days_Package.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    letterRendering: true
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            html2pdf().set(options).from(element).save();
        }
    </script>
</body>

</html>
