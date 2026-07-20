<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Giveaway;
use App\Models\Package;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    protected $packageImagePath = 'assets/images/packages';
    protected $itineraryImagePath = 'assets/images/packages/itinerary';

    public function index()
    {
        $packages = Package::latest()->paginate(20);
        $trashCount = Package::onlyTrashed()->count();

        return view('package.index', compact('packages', 'trashCount'));
    }

    public function create()
    {
        $package = new Package();
        $giveaways = Giveaway::all();
        $companies = Company::all();
        $trainingSessions = TrainingSession::all();

        return view('package.create', compact('package', 'giveaways', 'companies', 'trainingSessions'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        DB::transaction(function () use ($request, $data) {
            $package = new Package();
            $package->fill($data['package']);

            if ($request->hasFile('image')) {
                $package->image = $this->storeFile($request->file('image'), $this->packageImagePath);
            }

            $package->save();

            $this->saveRelations($request, $package, $data);
        });

        return redirect()->route('package.index')->with('success', 'Package created successfully.');
    }

    public function edit($id)
    {
        $package = Package::with([
            'accommodations',
            'itinerary',
            'terms',
            'maktabAddress',
            'transport',
            'transportFlights',
            'transportTrains',
            'giveaways',
            'trainingSessions',
        ])->findOrFail($id);

        $giveaways = Giveaway::all();
        $companies = Company::all();
        $trainingSessions = TrainingSession::all();

        return view('package.edit', compact('package', 'giveaways', 'companies', 'trainingSessions'));
    }

    public function show($id)
    {
        $package = Package::with([
            'company',
            'accommodations',
            'itinerary',
            'terms',
            'maktabAddress',
            'transport',
            'transportFlights',
            'transportTrains',
            'trainingSessions',
            'giveaways',
        ])->findOrFail($id);

        return view('package.show', compact('package'));
    }

    // public function pdf($id)
    // {
    //     $package = Package::with([
    //         'company',
    //         'accommodations',
    //         'itinerary',
    //         'terms',
    //         'maktabAddress',
    //         'transport',
    //         'transportFlights',
    //         'transportTrains',
    //         'trainingSessions',
    //         'giveaways',
    //     ])->findOrFail($id);

    //     $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('package.pdf', compact('package'))
    //         ->setPaper('a4', 'portrait');

    //     return $pdf->download($package->name . '.pdf');
    // }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $data = $this->validated($request);

        DB::transaction(function () use ($request, $package, $data) {
            $package->fill($data['package']);

            if ($request->hasFile('image')) {
                $this->deleteFile($package->image, $this->packageImagePath);
                $package->image = $this->storeFile($request->file('image'), $this->packageImagePath);
            }

            $package->save();

            $package->accommodations()->delete();
            $package->transportFlights()->delete();
            $package->transportTrains()->delete();

            $this->saveRelations($request, $package, $data);
        });

        return redirect()->route('package.index')->with('success', 'Package updated successfully.');
    }

    public function destroy($id)
    {
        Package::findOrFail($id)->delete();

        return back()->with('success', 'Package moved to trash.');
    }

    public function trash()
    {
        $packages = Package::onlyTrashed()->latest()->paginate(20);

        return view('package.trash', compact('packages'));
    }

    public function restore($id)
    {
        Package::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('package.trash')->with('success', 'Package restored successfully.');
    }


    private function storeFile($file, string $folder): string
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($folder), $filename);

        return $filename;
    }

    private function deleteFile(?string $filename, string $folder): void
    {
        if ($filename && file_exists(public_path($folder . '/' . $filename))) {
            unlink(public_path($folder . '/' . $filename));
        }
    }

    // ---- validation ----

    private function validated(Request $request): array
    {
        $package = $request->validate([
            'year' => 'nullable|string|max:20',
            'company_id' => 'nullable|integer|exists:companies,id',
            'package_number' => 'nullable|string|max:100',
            'category_zone' => 'nullable|string|max:150',
            'nearby' => 'nullable|string|max:150',
            'name' => 'required|string|max:200',
            'code' => 'nullable|string|max:100',
            'days' => 'nullable|integer',
            'travel_route' => 'nullable|string|max:150',
            'color' => 'nullable|string|max:20',
            'maktab' => 'required|string|max:150',
            'maktab_number' => 'required|string|max:100',
            'medina_arrival' => 'required|in:before_hajj,after_hajj',
            'hajj_duration' => 'required|in:short,long',

            'pkr_roe' => 'nullable|numeric',
            'usd_roe' => 'nullable|numeric',
            'gbp_roe' => 'nullable|numeric',
            'euro_roe' => 'nullable|numeric',
            'aed_roe' => 'nullable|numeric',
            'room_type' => 'nullable|string|max:100',
            'azizia_room_type' => 'nullable|string|max:100',
            'makkah_type' => 'nullable|string|max:100',
            'medinah_type' => 'nullable|string|max:100',
            'azizia_type' => 'nullable|string|max:100',
            'mina_type' => 'nullable|string|max:100',

            'adult_pkr' => 'nullable|numeric',
            'child_pkr' => 'nullable|numeric',
            'infant_pkr' => 'nullable|numeric',
            'adult_sar' => 'nullable|numeric',
            'child_sar' => 'nullable|numeric',
            'infant_sar' => 'nullable|numeric',
            'adult_usd' => 'nullable|numeric',
            'child_usd' => 'nullable|numeric',
            'infant_usd' => 'nullable|numeric',
            'adult_eur' => 'nullable|numeric',
            'child_eur' => 'nullable|numeric',
            'infant_eur' => 'nullable|numeric',
            'adult_gbp' => 'nullable|numeric',
            'child_gbp' => 'nullable|numeric',
            'infant_gbp' => 'nullable|numeric',
            'adult_aed' => 'nullable|numeric',
            'child_aed' => 'nullable|numeric',
            'infant_aed' => 'nullable|numeric',
        ]);

        $accommodations = $request->validate([
            'accommodations' => 'nullable|array',
            'accommodations.*.place' => 'nullable|string|max:150',
            'accommodations.*.accommodation_type' => 'nullable|string|max:150',
            'accommodations.*.saudi_star_rating' => 'nullable|string|max:50',
            'accommodations.*.hotel' => 'nullable|string|max:150',
            'accommodations.*.distance' => 'nullable|integer',
            'accommodations.*.check_in' => 'nullable|date',
            'accommodations.*.check_out' => 'nullable|date',
            'accommodations.*.food_package' => 'nullable|string|max:100',
            'accommodations.*.actual_hotel' => 'nullable|string|max:150',
            'accommodations.*.actual_check_in_time' => 'nullable|date',
            'accommodations.*.actual_check_out_time' => 'nullable|date',
            'accommodations.*.days' => 'nullable|integer',
            'accommodations.*.nights' => 'nullable|integer',
            'accommodations.*.group_ziarat' => 'nullable|string|max:150',
            'accommodations.*.religious_lectures' => 'nullable|string|max:150',
            'accommodations.*.distribution' => 'nullable|string|max:150',
            'accommodations.*.camp' => 'nullable|string|max:150',
            'accommodations.*.arafat' => 'nullable|string|max:150',
            'accommodations.*.shuttle' => 'nullable|string|max:150',
            'accommodations.*.bedding' => 'nullable|string|max:150',
            'accommodations.*.sharing' => 'nullable|string|max:150',
            'accommodations.*.sharing_type' => 'nullable|string|max:150',
            'accommodations.*.note' => 'nullable|string',
        ])['accommodations'] ?? [];

        $itinerary = $request->validate([
            'itinerary_description' => 'nullable|string',
        ]);

        $terms = $request->validate([
            'terms_content' => 'nullable|string',
        ]);

        // ---- Transport: general route row + repeatable flights + repeatable trains ----
        $transport = $request->validate([
            'transport_route' => 'nullable|string|max:150',
            'transport_arrival' => 'nullable|string|max:100',
            'transport_departure' => 'nullable|string|max:100',
            'transport_type' => 'nullable|string|max:100',
            'transport_vehicle' => 'nullable|string|max:100',
        ]);

        $flights = $request->validate([
            'flights' => 'nullable|array',
            'flights.*.airline' => 'nullable|string|max:150',
            'flights.*.flight_no' => 'nullable|string|max:100',
            'flights.*.flight_class' => 'nullable|string|max:100',
            'flights.*.origin' => 'nullable|string|max:150',
            'flights.*.destination' => 'nullable|string|max:150',
            'flights.*.departure_date' => 'nullable|date',
            'flights.*.departure_time' => 'nullable|date_format:H:i',
            'flights.*.arrival_date' => 'nullable|date',
            'flights.*.arrival_time' => 'nullable|date_format:H:i',
            'flights.*.pnr_no' => 'nullable|string|max:100',
            'flights.*.ticket_amount' => 'nullable|numeric',
            'flights.*.is_preferred' => 'nullable|boolean',
        ])['flights'] ?? [];

        $trains = $request->validate([
            'trains' => 'nullable|array',
            'trains.*.railway' => 'nullable|string|max:150',
            'trains.*.train_no' => 'nullable|string|max:100',
            'trains.*.train_class' => 'nullable|string|max:100',
            'trains.*.origin' => 'nullable|string|max:150',
            'trains.*.destination' => 'nullable|string|max:150',
            'trains.*.departure_date' => 'nullable|date',
            'trains.*.departure_time' => 'nullable|date_format:H:i',
            'trains.*.arrival_date' => 'nullable|date',
            'trains.*.arrival_time' => 'nullable|date_format:H:i',
            'trains.*.pnr_no' => 'nullable|string|max:100',
            'trains.*.ticket_amount' => 'nullable|numeric',
        ])['trains'] ?? [];

        $maktabAddress = $request->validate([
            'maktab_address' => 'nullable|string|max:200',
            'office_address' => 'nullable|string|max:200',
        ]);

        $giveaways = $request->validate([
            'giveaways' => 'nullable|array',
            'giveaways.*' => 'integer|exists:giveaways,id',
        ])['giveaways'] ?? [];

        $trainingSessions = $request->validate([
            'training_sessions' => 'nullable|array',
            'training_sessions.*' => 'integer|exists:training_sessions,id',
        ])['training_sessions'] ?? [];

        return compact(
            'package',
            'accommodations',
            'itinerary',
            'terms',
            'transport',
            'flights',
            'trains',
            'maktabAddress',
            'giveaways',
            'trainingSessions'
        );
    }

    private function saveRelations(Request $request, Package $package, array $data): void
    {
        foreach ($data['accommodations'] as $row) {
            $package->accommodations()->create($row);
        }

        $existingItinerary = $package->itinerary;
        $itineraryData = ['description' => $data['itinerary']['itinerary_description'] ?? null];

        $imageFields = [
            'mina_image',
            'arafat_image',
            'muzdalifah_image',
            'makkah_mina_rami_day_one_image',
            'mina_rami_day_two_image',
            'mina_makkah_rami_day_three_image',
        ];

        foreach ($imageFields as $imageField) {
            if ($request->hasFile($imageField)) {
                if ($existingItinerary && $existingItinerary->$imageField) {
                    $this->deleteFile($existingItinerary->$imageField, $this->itineraryImagePath);
                }
                $itineraryData[$imageField] = $this->storeFile($request->file($imageField), $this->itineraryImagePath);
            }
        }

        $package->itinerary()->updateOrCreate(['package_id' => $package->id], $itineraryData);

        // Terms & Condition
        $package->terms()->updateOrCreate(
            ['package_id' => $package->id],
            ['content' => $data['terms']['terms_content'] ?? null]
        );

        // ---- Transport ----
        // General route row (Route / Arrival / Departure / Type / Vehicle)
        $package->transport()->updateOrCreate(
            ['package_id' => $package->id],
            [
                'route' => $data['transport']['transport_route'] ?? null,
                'arrival' => $data['transport']['transport_arrival'] ?? null,
                'departure' => $data['transport']['transport_departure'] ?? null,
                'type' => $data['transport']['transport_type'] ?? null,
                'vehicle' => $data['transport']['transport_vehicle'] ?? null,
            ]
        );

        // Flights (repeatable)
        foreach ($data['flights'] as $row) {
            $row['is_preferred'] = filter_var($row['is_preferred'] ?? false, FILTER_VALIDATE_BOOLEAN);
            $package->transportFlights()->create($row);
        }

        // Trains (repeatable)
        foreach ($data['trains'] as $row) {
            $package->transportTrains()->create($row);
        }

        // Maktab Address
        $package->maktabAddress()->updateOrCreate(
            ['package_id' => $package->id],
            $data['maktabAddress']
        );

        // Giveaways (checkboxes)
        $package->giveaways()->sync($data['giveaways']);

        // Training Sessions (checkboxes)
        $package->trainingSessions()->sync($data['trainingSessions']);
    }
}
