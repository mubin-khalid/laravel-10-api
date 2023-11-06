<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use EmployeeService;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    protected $employee;

    public function __construct(EmployeeService $employee)
    {
        $this->employee = $employee;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->employee->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        return $this->employee->create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return $employee;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        return $this->employee->update($request, $employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->employee->delete($id);
    }
}
