<?php

namespace App\Repositories;

use App\Models\Company;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class CompanyRepository
{
    /**
     * @throws Exception
     * @return JsonResponse
     */
    public function getDataTable(): JsonResponse
    {
        $companies = Company::query();

        return DataTables::of($companies)
            ->addColumn('actions', function ($company) {
                return view('companies.partials.actions', compact('company'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function all(): Collection|array
    {
        return Company::query()->limit(1000)->get();
    }

    public function paginate(): LengthAwarePaginator
    {
        return Company::query()->paginate();
    }

    public function one(int|null $id): Model|Collection|Builder|array|null
    {
        return Company::query()->find($id);
    }

    public function store(array $validated, string|null $logoHashName): array|null|Builder|Collection|Model
    {
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if(!empty($logoHashName)) {
            $data['logo'] = $logoHashName;
        }

        $companyId = Company::query()->insertGetId($data);

        return $this->one($companyId);
    }

    public function update(int $id, array $validated, string|null $logoHashName): void
    {
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'updated_at' => now(),
        ];

        if(!empty($logoHashName)) {
            $data['logo'] = $logoHashName;
        }

        Company::query()
            ->where('id', $id)
            ->update($data);
    }

    public function destroy(int $id): void
    {
        Company::query()->where('id', $id)->delete();
    }
}
