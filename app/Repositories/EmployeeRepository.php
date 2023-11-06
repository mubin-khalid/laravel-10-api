<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    /**
     * @var Employee
     */
    protected $employee;

    /**
     * EmployeeRepository constructor.
     *
     * @param Employee $employee
     */
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Get all Companies.
     *
     * @return Employee $employee
     */
    public function getAll()
    {
        return $this->employee->with('company')->paginate(10);
    }

    /**
     * Get Employee by id
     *
     * @param $id
     * @return integer
     */
    public function getById($id)
    {
        return $this->employee->where("id", $id)->get();
    }

    /**
     * Save Employee
     *
     * @param $data
     * @return Employee
     */
    public function save($data)
    {
        $employee = new $this->employee();

        $employee->fill($data);

        $employee->save();

        return $employee->fresh('company');
    }

    /**
     * Update Employee
     *
     * @param $data
     * @return Employee
     */
    public function update($data, $employee)
    {
        $employee->fill($data);
        
        $employee->update();

        return $employee->fresh('company');
    }

    /**
     * Update Employee
     *
     * @param $data
     * @return Employee
     */
    public function delete($id)
    {
        $employee = $this->employee->find($id);
        if(!$employee) {
            return false;
        }
        $employee->delete();

        return $employee;
    }
}
