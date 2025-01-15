<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;
use Exception;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private EmployeeRepository $employeeRepository;
    private CompanyRepository $companyRepository;

    public function __construct(EmployeeRepository $employeeRepository, CompanyRepository $companyRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * Display a listing of the resource.
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->employeeRepository->getDataTable();
        }

        return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = $this->companyRepository->all();

        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $this->employeeRepository->store($request->validated());

        return redirect()->route('employee.index')->with('success', 'Employee Store');
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
    public function edit(Employee $employee)
    {
        $companies = $this->companyRepository->all();

        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, int $id)
    {
        $this->employeeRepository->update($id, $request->validated());

        return redirect()->route('employee.index')->with('success', 'Employee Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->employeeRepository->destroy($id);

        return redirect()->route('employee.index')->with('success', 'Employee Delete');
    }
}
