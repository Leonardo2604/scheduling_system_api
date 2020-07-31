<?php

namespace App\Repositories\Contracts;

use App\Entities\Employee;

interface EmployeeRepository
{
    /**
     * @return App\Entities\Employee[]
     */
    public function getAll(): array;

    /**
     * @param int $id
     * @return App\Entities\Employee
     */
    public function find(int $id): Employee;

    /**
     * @param App\Entities\Employee $employee
     */
    public function create(Employee $employee): Employee;

    /**
     * @param App\Entities\Employee $employee
     */
    public function update(Employee $employee);

    /**
     * @param App\Entities\Employee $employee
     */
    public function delete(Employee $employee);
}