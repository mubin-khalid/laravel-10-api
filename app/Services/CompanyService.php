<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Exception;
use Illuminate\Support\Facades\Log;
use CompanyRepository;
use Storage;

class CompanyService
{

    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function getAll()
    {
        return $this->companyRepository->getAll();
    }

    public function getList()
    {
        return $this->companyRepository->getList();
    }

    public function getById($id)
    {
        return $this->companyRepository->getById($id);
    }

    public function create($company)
    {
        $data = $company->only(['name', 'email', 'website']);
        if ($company->hasFile('logo')) {
            $data['logo'] = $company->file('logo')->store('public');
        }
        return $this->companyRepository->save($data);
    }

    public function update($request, $company)
    {
        $data = $request->only(['name', 'email', 'website']);
        if ($request->hasFile('logo')) {
            Storage::delete($company->logo);
            $company->logo = str_replace('public/', 'storage/', $request->file('logo')->store('public'));
        }
        return $this->companyRepository->update($data, $company);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $company = $this->companyRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete company data');
        }

        DB::commit();

        return $company;
    }

    public function updateLogo($request, $company)
    {
        if ($request->hasFile('logo')) {
            if($company->logo !== '' && $company->logo !== null) {
                Storage::delete($company->logo);
            }
            $company->logo = str_replace('public/', 'storage/', $request->file('logo')->store('public'));
        } else {
            $company->logo = '';
        }
        $company->save();
        return $company->logo;
    }
}
