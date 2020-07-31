<?php

namespace App\Services\V1;

use App\Entities\Employee;
use App\Repositories\Contracts\EmployeeRepository;
use App\Services\Contracts\EmployeeService;
use DateTime;

class EmployeeServiceV1 implements EmployeeService
{
    private EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getAll(): array
    {
        return $this->employeeRepository->getAll();
    }

    public function create(array $data)
    {
        $employee = new Employee(
            null,
            $data['name'],
            new DateTime(),
            new DateTime()
        );

        return $this->employeeRepository->create($employee);
    }

    public function update(int $id, array $data)
    {
        $current = $this->employeeRepository->find($id);
        $employee = new Employee(
            $current->getId(),
            $data['name'],
            $current->getCreatedAt(),
            new DateTime()
        );

        return $this->employeeRepository->update($employee);
    }

    public function delete(int $id)
    {
        $employee = $this->employeeRepository->find($id);
        $this->employeeRepository->delete($employee);
    }
}