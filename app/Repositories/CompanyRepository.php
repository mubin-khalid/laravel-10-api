<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    /**
     * @var Company
     */
    protected $company;

    /**
     * CompanyRepository constructor.
     *
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Get all Companies.
     *
     * @return Company $company
     */
    public function getAll()
    {
        return $this->company->paginate(10);
    }

    public function getList()
    {
        return $this->company->select('name', 'id')->get();
    }

    /**
     * Get company by id
     *
     * @param $id
     * @return integer
     */
    public function getById($id)
    {
        return $this->company->where("id", $id)->get();
    }

    /**
     * Save Company
     *
     * @param $data
     * @return Company
     */
    public function save($data)
    {
        $company = new $this->company();

        $company->fill($data);

        $company->save();

        return $company->fresh();
    }

    /**
     * Update Company
     *
     * @param $data
     * @return Company
     */
    public function update($data, $company)
    {
        $company->fill($data);
        
        $company->update();

        return $company->fresh();
    }

    /**
     * Update Company
     *
     * @param $data
     * @return Company
     */
    public function delete($id)
    {
        $company = $this->company->find($id);
        $company->delete();

        return $company;
    }
}

