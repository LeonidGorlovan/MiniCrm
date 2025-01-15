<?php

namespace App\Repositories;

use App\Models\Employee;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class EmployeeRepository
{
    /**
     * @throws Exception
     * @return JsonResponse
     */
    public function getDataTable(): JsonResponse
    {
        $employees = Employee::query()->with('company');

        return DataTables::of($employees)
            ->addColumn('company_name', function ($employee) {
                return $employee->company->name ?? 'none'; // Если компания отсутствует
            })
            ->addColumn('actions', function ($employees) {
                return view('employees.partials.actions', compact('employees'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function all(): Collection|array
    {
        return Employee::query()->limit(1000)->get();
    }

    public function paginate(): LengthAwarePaginator
    {
        return Employee::query()->paginate();
    }

    public function one(int|null $id): Model|Collection|Builder|array|null
    {
        return Employee::query()->find($id);
    }

    public function store(array $validated): void
    {
        Employee::query()->insert([
            'company_id' => $validated['company_id'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function update(int $id, array $validated): void
    {
        Employee::query()
            ->where('id', $id)
            ->update([
                'company_id' => $validated['company_id'],
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'updated_at' => now(),
            ]);
    }

    public function destroy(int $id): void
    {
        Employee::query()->where('id', $id)->delete();
    }
}
