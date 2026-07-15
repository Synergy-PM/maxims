<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->get();
        $trashCount = Company::onlyTrashed()->count();

        return view('company.index', compact('companies', 'trashCount'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255|unique:companies,name',
            'status' => 'required|in:active,inactive',
        ]);

        $company = Company::create([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        logUserActivity(
            'Company Created',
            'Name: ' . $company->name . ' | Status: ' . $company->status,
            $company->id,
            'Company'
        );

        return redirect()->route('company.index')
            ->with('success', 'Company created successfully.');
    }
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('company.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255|unique:companies,name,' . $id,
            'status' => 'required|in:active,inactive',
        ]);

        $oldName = $company->name;

        $company->update([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        logUserActivity(
            'Company Updated',
            "Name changed from '{$oldName}' to '{$company->name}' | Status: {$company->status}",
            $company->id,
            'Company'
        );

        return redirect()->route('company.index')
            ->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $companyName = $company->name;

        logUserActivity('Company Deleted', 'Moved to trash: ' . $companyName, $company->id, 'Company');

        $company->delete();

        return redirect()->route('company.index')
            ->with('success', 'Company moved to trash.');
    }

    public function trash()
    {
        $companies = Company::onlyTrashed()->latest()->get();
        return view('company.trash', compact('companies'));
    }

    public function restore($id)
    {
        $company = Company::onlyTrashed()->findOrFail($id);
        $companyName = $company->name;

        $company->restore();

        logUserActivity('Company Restored', 'Restored from trash: ' . $companyName, $company->id, 'Company');

        return redirect()->route('company.index')
            ->with('success', 'Company restored successfully.');
    }
}
