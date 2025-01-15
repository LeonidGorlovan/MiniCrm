<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use App\Services\UploadLogoService;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private CompanyRepository $companyRepository;
    private UploadLogoService $logoService;

    public function __construct(CompanyRepository $companyRepository, UploadLogoService $logoService)
    {
        $this->companyRepository = $companyRepository;
        $this->logoService = $logoService;
    }

    /**
     * Display a listing of the resource.
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->companyRepository->getDataTable();
        }

        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $logoHashName = $this->logoService->upload($request->file('logo'), null);
        $this->companyRepository->store($request->validated(), $logoHashName);

        return redirect()->route('company.index')->with('success', 'Company Store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, int $id)
    {
        $logoHashName = $this->logoService->upload($request->file('logo'), $id);
        $this->companyRepository->update($id, $request->validated(), $logoHashName);

        return redirect()->route('company.index')->with('success', 'Company Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->logoService->delete($id);
        $this->companyRepository->destroy($id);

        return redirect()->route('company.index')->with('success', 'Company delete');
    }
}
