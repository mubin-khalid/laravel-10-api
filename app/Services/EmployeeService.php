<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Exception;
use Illuminate\Support\Facades\Log;
use EmployeeRepository;

class EmployeeService
{

    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getAll()
    {
        return $this->employeeRepository->getAll();
    }

    public function getById($id)
    {
        return $this->employeeRepository->getById($id);
    }

    public function create($employee)
    {
        $data = $employee->only(['first_name', 'last_name', 'email', 'company', 'phone']);
        return $this->employeeRepository->save($data);
    }

    public function update($request, $employee)
    {
        
        $data = $request->only(['first_name', 'last_name', 'email', 'company', 'phone']);
        return $this->employeeRepository->update($data, $employee);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete company data');
        }

        DB::commit();

        return $employee;
    }
}
