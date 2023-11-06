<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use CompanyService;

class CompanyController extends Controller
{
    protected $company;
    public function __construct(CompanyService $companyService)
    {
        $this->company = $companyService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->company->getAll();
    }

    /**
     * Get list for employee functionalities.
     */
    public function getList()
    {
        return $this->company->getList();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        return $this->company->create($request);
    }

    /**
     * Display the specified resource.
     */

    public function show(Company $company)
    {
        return $company;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        return $this->company->update($request, $company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->company->delete($id);
    }

    public function updateImage(Request $request, Company $company)
    {
        $this->validate($request, [
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_width=100,min_height=100',
        ]);

        $status = $this->company->updateLogo($request, $company);
        return response()->json([
            'success' => true,
            'path' => $status,
        ], 200);
    }
}
