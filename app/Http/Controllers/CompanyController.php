<?php

namespace App\Http\Controllers;

use App\Enums\CurrencyType;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Enum;

class CompanyController extends Controller
{
    public function index()
    {
        // $this->authorize('company_index');
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }
    public function create()
    {
        // $this->authorize('company_create');
        $company = null;
        return view('companies.create', compact('company'));
    }

    public function store(Request $request)
    {
        // $this->authorize('company_create');

        $request->validate([
            // Company Details
            'company_name' => 'required|string|max:255',
            'company_code' => 'required|string|max:255|unique:companies,company_code',
            'currency_type' => ['required', new Enum(CurrencyType::class)],
            'established_on' => 'required|date',
            'quota' => 'required|integer|min:0',
            'website' => 'nullable|url|max:255',
            'company_status_on_establishment' => 'nullable|string|max:255',
            'current_company_status' => 'nullable|string|max:255',

            // Files
            'company_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'company_stamp' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'letter_head_header' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'letter_head_footer' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'company_signature' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // Registration
            'mohra_enrollment_no' => 'nullable|string|max:255',
            'munazzam_no' => 'nullable|string|max:255',
            'cluster_enrollment_no' => 'nullable|string|max:255',
            'dts_no' => 'nullable|string|max:255',
            'dts_expiry' => 'nullable|date',
            'iata_no' => 'nullable|string|max:255',
            'iata_expiry' => 'nullable|date',
            'ntn' => 'nullable|string|max:255',

            // Director
            'director_name' => 'nullable|string|max:255',
            'director_cnic' => 'nullable|string|max:255',
            'director_cnic_expiry' => 'nullable|date',
            'director_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'director_detail' => 'nullable|string',

            // Bank
            'bank_name' => 'nullable|string|max:255',
            'account_title' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {

            $data = $request->except([
                'company_logo',
                'company_stamp',
                'letter_head_header',
                'letter_head_footer',
                'company_signature',
                'director_photo'
            ]);

            if ($request->hasFile('company_logo')) {
                $data['company_logo'] = $request->file('company_logo')
                    ->store('companies/logo', 'public');
            }

            if ($request->hasFile('company_stamp')) {
                $data['company_stamp'] = $request->file('company_stamp')
                    ->store('companies/stamp', 'public');
            }

            if ($request->hasFile('letter_head_header')) {
                $data['letter_head_header'] = $request->file('letter_head_header')
                    ->store('companies/letter_head/header', 'public');
            }

            if ($request->hasFile('letter_head_footer')) {
                $data['letter_head_footer'] = $request->file('letter_head_footer')
                    ->store('companies/letter_head/footer', 'public');
            }

            if ($request->hasFile('company_signature')) {
                $data['company_signature'] = $request->file('company_signature')
                    ->store('companies/signature', 'public');
            }

            if ($request->hasFile('director_photo')) {
                $data['director_photo'] = $request->file('director_photo')
                    ->store('companies/director', 'public');
            }

            Company::create($data);

            DB::commit();

            return redirect()
                ->route('company.index')
                ->with('success', 'Company created successfully.');
        } catch (Exception $e) {

            DB::rollBack();

            foreach (
                [
                    'company_logo',
                    'company_stamp',
                    'letter_head_header',
                    'letter_head_footer',
                    'company_signature',
                    'director_photo'
                ] as $file
            ) {

                if (isset($data[$file]) && Storage::disk('public')->exists($data[$file])) {
                    Storage::disk('public')->delete($data[$file]);
                }
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong. ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // $this->authorize('company_edit');
        $company = Company::findOrFail($id);
        return view('companies.create', compact('company'));
    }

    public function update(Request $request, $id)
    {
        // $this->authorize('company_edit');

        $company = Company::findOrFail($id);

        $request->validate([
            // Company Details
            'company_name' => 'required|string|max:255',
            'company_code' => 'required|string|max:255|unique:companies,company_code,' . $company->id,
            'currency_type' => ['required', new Enum(CurrencyType::class)],
            'established_on' => 'required|date',
            'quota' => 'required|integer|min:0',
            'website' => 'nullable|url|max:255',
            'company_status_on_establishment' => 'nullable|string|max:255',
            'current_company_status' => 'nullable|string|max:255',

            // Files
            'company_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'company_stamp' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'letter_head_header' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'letter_head_footer' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'company_signature' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // Registration
            'mohra_enrollment_no' => 'nullable|string|max:255',
            'munazzam_no' => 'nullable|string|max:255',
            'cluster_enrollment_no' => 'nullable|string|max:255',
            'dts_no' => 'nullable|string|max:255',
            'dts_expiry' => 'nullable|date',
            'iata_no' => 'nullable|string|max:255',
            'iata_expiry' => 'nullable|date',
            'ntn' => 'nullable|string|max:255',

            // Director
            'director_name' => 'nullable|string|max:255',
            'director_cnic' => 'nullable|string|max:255',
            'director_cnic_expiry' => 'nullable|date',
            'director_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'director_detail' => 'nullable|string',

            // Bank
            'bank_name' => 'nullable|string|max:255',
            'account_title' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        $newFiles = [];

        try {

            $data = $request->except([
                'company_logo',
                'company_stamp',
                'letter_head_header',
                'letter_head_footer',
                'company_signature',
                'director_photo',
                '_token',
                '_method',
            ]);

            $fileFields = [
                'company_logo' => 'companies/logo',
                'company_stamp' => 'companies/stamp',
                'letter_head_header' => 'companies/letter_head/header',
                'letter_head_footer' => 'companies/letter_head/footer',
                'company_signature' => 'companies/signature',
                'director_photo' => 'companies/director',
            ];

            $oldFilesToDelete = [];

            foreach ($fileFields as $field => $path) {
                if ($request->hasFile($field)) {
                    $data[$field] = $request->file($field)->store($path, 'public');
                    $newFiles[$field] = $data[$field];

                    if ($company->$field) {
                        $oldFilesToDelete[] = $company->$field;
                    }
                }
            }

            $company->update($data);

            foreach ($oldFilesToDelete as $oldFile) {
                if (Storage::disk('public')->exists($oldFile)) {
                    Storage::disk('public')->delete($oldFile);
                }
            }

            DB::commit();

            return redirect()
                ->route('company.index')
                ->with('success', 'Company updated successfully.');
        } catch (Exception $e) {

            DB::rollBack();

            foreach ($newFiles as $file) {
                if (Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong. ' . $e->getMessage());
        }
    }
}
