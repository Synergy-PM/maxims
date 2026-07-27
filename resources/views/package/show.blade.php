<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $package->name ?? 'Executive Platinum' }} - {{ $package->days ?? '14' }} Days Package</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- html2pdf.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
        :root {
            --navy: #131738;
            --gold: #d9a441;
            --gold-dark: #c8922e;
            --grey-row: #e5e5e5;
            --border-color: #000000;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #d4d4d4;
            color: #131738;
            padding-top: 10px;
        }

        /* Top Action Bar */
        .action-bar {
            max-width: 1000px;
            margin: 0 auto 10px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 5px;
        }

        .btn-back {
            background-color: var(--navy);
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 8px 18px;
            border-radius: 4px;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: #050714;
            color: #fff;
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

        /* Sheet Document Container */
        .sheet {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            padding: 15px 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, .15);
            box-sizing: border-box;
        }

        /* Top Header Banner */
        .header-banner {
            display: flex;
            align-items: stretch;
            margin-bottom: 8px;
        }

        .header-left {
            background: var(--navy);
            color: var(--gold);
            padding: 8px 15px;
            flex: 2.2;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .header-left h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            font-size: 1.6rem;
            margin: 0;
            line-height: 1.1;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .header-left .subtitle {
            color: #ffffff;
            font-weight: 700;
            font-size: .75rem;
            letter-spacing: .5px;
            margin-top: 2px;
            text-transform: uppercase;
        }

        .header-right {
            background: linear-gradient(135deg, var(--gold-dark), var(--gold) 50%, #b9812a);
            color: var(--navy);
            flex: 1.4;
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 4px 10px;
            position: relative;
        }

        .pkg-code-box {
            text-align: center;
            font-weight: 800;
        }

        .pkg-code-box .lbl {
            font-size: .58rem;
            letter-spacing: 0.5px;
            color: #131738;
        }

        .pkg-code-box .code {
            font-size: 1rem;
            background: var(--navy);
            color: #fff;
            padding: 1px 7px;
            border-radius: 2px;
            font-weight: 800;
        }

        .header-right .days {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-weight: 700;
            font-size: 1.6rem;
            color: var(--navy);
            line-height: 1;
        }

        .tags-container {
            position: absolute;
            bottom: 4px;
            right: 10px;
            display: flex;
            gap: 4px;
        }

        .tag-badge {
            background: var(--navy);
            color: #fff;
            font-size: .58rem;
            font-weight: 700;
            padding: 1px 5px;
            border-radius: 2px;
        }

        /* Accommodation Main Table Header & Body */
        .pkg-table {
            border-collapse: collapse;
            width: 100%;
            font-size: .75rem;
        }

        .pkg-table th,
        .pkg-table td {
            border: 1px solid var(--border-color);
            text-align: center;
            vertical-align: middle;
            padding: 3px 6px;
        }

        .pkg-table thead th {
            background: var(--navy) !important;
            color: #ffffff !important;
            font-weight: 700;
            font-size: .78rem;
            letter-spacing: .5px;
            text-transform: uppercase;
            text-align: center !important;
        }

        .pkg-table tbody tr:nth-child(odd) {
            background: var(--grey-row);
        }

        .pkg-table tbody tr:nth-child(even) {
            background: #ffffff;
        }

        .stars {
            color: #d9a441;
            font-size: .8rem;
            margin-left: 4px;
        }

        /* Middle Note Strip */
        .note-strip {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 6px 0;
        }

        .ticket-note {
            font-weight: 800;
            font-size: 0.8rem;
            color: #131738;
            white-space: nowrap;
        }

        .note-box {
            background: var(--navy);
            color: #fff;
            font-size: .68rem;
            padding: 4px 8px;
            border-radius: 2px;
            flex: 1;
            text-align: center;
            font-weight: 600;
        }

        .note-box b {
            background: #fff;
            color: var(--navy);
            padding: 0 4px;
            margin-right: 4px;
            border-radius: 2px;
        }

        /* ROOM TYPE PRICING TABLE */
        .room-table-container {
            border: 1px solid var(--border-color);
            margin-bottom: 6px;
        }

        .room-table {
            border-collapse: collapse;
            width: 100%;
            font-size: .75rem;
            margin-bottom: 0;
        }

        .room-table td {
            border: 1px solid var(--border-color);
            padding: 5px 10px;
            vertical-align: middle;
        }

        .room-table .room-type-sidebar {
            background: var(--navy);
            color: #ffffff;
            font-weight: 800;
            font-size: .88rem;
            text-align: center;
            width: 20%;
            letter-spacing: .5px;
        }

        .room-table .room-label {
            width: 30%;
            text-align: center;
            font-weight: 600;
            background: #fdfdfd;
            color: #333;
        }

        .room-table .room-price {
            width: 50%;
            text-align: center;
            font-weight: 700;
            background: var(--grey-row);
            color: #000;
        }

        .price-disclaimer {
            text-align: right;
            font-size: .68rem;
            font-weight: 700;
            margin: 2px 0 6px 0;
            color: #222;
        }

        /* Bottom Details & Notes Section */
        .icon-box {
            border: 2px solid var(--gold);
            border-radius: 6px;
            padding: 6px;
            height: 100%;
        }

        .icon-item {
            text-align: center;
            margin-bottom: 5px;
        }

        .icon-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--navy);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2px;
            font-size: .85rem;
        }

        .icon-item .label {
            font-weight: 800;
            font-size: .65rem;
            line-height: 1.1;
        }

        .icon-item .desc {
            font-size: .55rem;
            color: #444;
            line-height: 1.1;
        }

        .zone-badge {
            background: var(--navy);
            color: var(--gold);
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 12px;
            display: inline-block;
            font-size: .68rem;
        }

        .zone-badge small {
            display: block;
            color: #fff;
            font-size: .48rem;
            font-weight: 600;
        }

        .notes-title {
            font-weight: 900;
            font-size: .88rem;
            margin-bottom: 2px;
        }

        .notes-list {
            font-size: .65rem;
            line-height: 1.25;
        }

        .notes-list li {
            margin-bottom: 2px;
        }

        .taxi-strip {
            background: var(--navy);
            color: #fff;
            font-size: .6rem;
            text-align: center;
            padding: 3px;
            font-weight: 600;
            margin-bottom: 3px;
            border-radius: 2px;
        }
    </style>
</head>

<body>

    <!-- Top Action Bar -->
    <div class="action-bar">
        <a href="{{ route('package.index') }}" class="btn-back">⬅ Back to List</a>
        <button class="btn-download" onclick="downloadPackagePDF()">📥 Download PDF</button>
    </div>

    <div class="sheet" id="packageSheet">
        <!-- Header Banner -->
        <div class="header-banner">
            <div class="header-left">
                <h1>{{ $package->name ?? 'EXECUTIVE PLATINUM' }}</h1>
                <div class="subtitle">{{ $package->travel_route ?? 'INTERCON / FAIRMONT - MAKKAH FIRST' }}</div>
            </div>
            <div class="header-right">
                <div class="pkg-code-box">
                    <div class="lbl">PKG CODE</div>
                    <div class="code">{{ $package->code ?? 'UB 002' }}</div>
                </div>
                <div class="days">{{ $package->days ?? '14' }} Days Package</div>
                <div class="tags-container">
                    <span
                        class="tag-badge">{{ strtoupper(str_replace('_', ' ', $package->medina_arrival ?? 'NON SHIFTING')) }}</span>
                    <span class="tag-badge">{{ strtoupper($package->hajj_duration ?? 'NON AZIZIYA') }}</span>
                </div>
            </div>
        </div>

        @php
            $itineraryList = [];
            $dayCounter = 1;

            if (!empty($package->accommodations) && count($package->accommodations) > 0) {
                foreach ($package->accommodations as $acc) {
                    $checkIn = isset($acc['check_in']) ? \Carbon\Carbon::parse($acc['check_in']) : null;
                    $checkOut = isset($acc['check_out']) ? \Carbon\Carbon::parse($acc['check_out']) : null;

                    // Dynamic Star Rating Display
                    $starRating = isset($acc['saudi_star_rating']) ? (int) $acc['saudi_star_rating'] : 0;
                    if (!$starRating && isset($acc->saudi_star_rating)) {
                        $starRating = (int) $acc->saudi_star_rating;
                    }
                    $starsHtml = str_repeat('★', $starRating);

                    if ($checkIn && $checkOut) {
                        // Subtracting 1 day so Check-out date is not counted as an extra day row
                        $period = \Carbon\CarbonPeriod::create($checkIn, $checkOut->copy()->subDay());
                        foreach ($period as $date) {
                            $itineraryList[] = [
                                'day' => sprintf('%02d', $dayCounter++),
                                'date' => $date->format('d M'),
                                'city' => $acc['place'] ?? ($acc->place ?? 'Makkah'),
                                'hotel' => $acc['hotel'] ?? ($acc->hotel ?? '-'),
                                'stars' => $starsHtml,
                            ];
                        }
                    }
                }
            }
        @endphp

        <!-- Main Accommodation Table -->
        <div class="table-responsive">
            <table class="pkg-table">
                <thead>
                    <tr>
                        <th style="width: 8%;">DAY</th>
                        <th style="width: 14%;">DATE (AD)</th>
                        <th style="width: 18%;">CITY</th>
                        <th style="width: 60%; text-align: center;">ACCOMMODATION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($itineraryList as $item)
                        <tr>
                            <td><b>{{ $item['day'] }}</b></td>
                            <td>{{ $item['date'] }}</td>
                            <td>{{ $item['city'] }}</td>
                            <td class="text-start ps-3">
                                {{ $item['hotel'] }}
                                @if (!empty($item['stars']))
                                    <span class="stars">{{ $item['stars'] }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        @for ($i = 1; $i <= ($package->days ?? 14); $i++)
                            <tr>
                                <td><b>{{ sprintf('%02d', $i) }}</b></td>
                                <td>-</td>
                                <td>Makkah / Medinah</td>
                                <td class="text-start ps-3">Hotel Information Pending</td>
                            </tr>
                        @endfor
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Note Strip -->
        <div class="note-strip">
            <div class="ticket-note">{{ $package->ticket_note ?? 'Ticket & Qurbani not Included' }}</div>
            <div class="note-box">
                <b>NOTE:</b>
                {{ $package->retention_note ?? 'MAKKAH HOTEL ROOMS WILL BE RETAINED FROM 08 ZIL HAJJ TO 12 ZIL HAJJ.' }}
            </div>
        </div>

        @php
            $makkahA = is_string($package->makkah_a ?? null)
                ? json_decode($package->makkah_a, true)
                : $package->makkah_a ?? [];
            $makkahB = is_string($package->makkah_b ?? null)
                ? json_decode($package->makkah_b, true)
                : $package->makkah_b ?? [];

            $quadPrice = !empty($makkahB['quad'])
                ? 'SAR ' . number_format((float) $makkahB['quad']) . '/-'
                : (!empty($makkahA['quad'])
                    ? 'SAR ' . number_format((float) $makkahA['quad']) . '/-'
                    : 'NA');

            $triplePrice = !empty($makkahB['triple'])
                ? 'SAR ' . number_format((float) $makkahB['triple']) . '/-'
                : (!empty($makkahA['triple'])
                    ? 'SAR ' . number_format((float) $makkahA['triple']) . '/-'
                    : 'SAR 94,600/-');

            $doublePrice = !empty($makkahB['double'])
                ? 'SAR ' . number_format((float) $makkahB['double']) . '/-'
                : (!empty($makkahA['double'])
                    ? 'SAR ' . number_format((float) $makkahA['double']) . '/-'
                    : 'SAR 118,500/-');
        @endphp

        <!-- ROOM TYPE PRICING TABLE -->
        <div class="room-table-container">
            <table class="room-table">
                <tbody>
                    <tr>
                        <td rowspan="3" class="room-type-sidebar">ROOM TYPE</td>
                        <td class="room-label">QUAD Per Person</td>
                        <td class="room-price">{{ $quadPrice }}</td>
                    </tr>
                    <tr>
                        <td class="room-label">TRIPLE Per Person</td>
                        <td class="room-price">{{ $triplePrice }}</td>
                    </tr>
                    <tr>
                        <td class="room-label">DOUBLE Per Person</td>
                        <td class="room-price">{{ $doublePrice }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="price-disclaimer">"Book Early, Prices and Packages Subject to Change."</div>

        <!-- Bottom Icons and Terms/Notes -->
        <div class="row">
            <div class="col-lg-5 mb-2">
                <div class="icon-box">
                    <div class="row">
                        <div class="col-6 icon-item">
                            <div class="text-center mb-1">
                                <span class="zone-badge">ZONE {{ $package->category_zone ?? '1' }}<small>MAKTAB
                                        {{ $package->maktab ?? 'A-CATEGORY' }}</small></span>
                            </div>
                            <div class="label">BEST LOCATION IN MINA</div>
                            <div class="desc">
                                {{ $package->mina_tent_desc ?? 'AVG 16 PEOPLE TO A TENT' }}<br>{{ $package->bed_size_desc ?? 'SOFA CUM BED SIZE 50-55 CM EACH' }}
                            </div>
                        </div>
                        <div class="col-6 icon-item">
                            <div class="icon-circle">🍽️</div>
                            <div class="label">MAKKAH &amp; MEDINAH</div>
                            <div class="desc">{{ $package->hotel_meal_plan ?? 'HALF BOARD BASIS' }}</div>
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
                            <div class="label">{{ $package->transport_type ?? 'BULLET TRAIN / LUXURY BUS' }}</div>
                            <div class="desc">{{ $package->transport_desc ?? 'MODEL 2025/2026 WITH BATHROOM' }}</div>
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
                        <li>Family Rooms available in Aziziya Building duration of 05 days of Hajj with Supplement SAR
                            20,000.</li>
                    @endif
                </ul>
                <div class="taxi-strip">FAMILY CAR / TAXI SERVICES AVAILABLE SAR
                    {{ $package->jeddah_taxi_fare ?? '600' }} PER PERSON FROM JEDDAH AIRPORT TO MAKKAH HOTEL &amp; V.V
                </div>
                <div class="taxi-strip">FAMILY CAR / TAXI SERVICES AVAILABLE SAR
                    {{ $package->madinah_taxi_fare ?? '150' }} PER PERSON FROM MEDINAH AIRPORT TO MEDINAH HOTEL &amp;
                    V.V</div>
            </div>
        </div>
    </div>

    <script>
        function downloadPackagePDF() {
            const element = document.getElementById('packageSheet');
            const options = {
                margin: [4, 4, 4, 4],
                filename: '{{ $package->code ?? 'Package' }}_{{ $package->days ?? '14' }}_Days_Package.pdf',
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
