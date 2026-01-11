<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = $this->companyRepository->getCompaniesWithPaginate();
        return view('company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        try {
            $this->companyRepository->createCompany($request->validated());
            return redirect()->route('companies.index')->with('success', 'Company created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the company: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        try {
            $this->companyRepository->updateCompany($company->id, $request->validated());
            return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the company: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try {
            $this->companyRepository->deleteCompany($company->id);
            return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the company: ' . $e->getMessage());
        }
    }
}
