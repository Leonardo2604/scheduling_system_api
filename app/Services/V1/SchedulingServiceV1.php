<?php

namespace App\Services\V1;

use App\Entities\Scheduling;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\EmployeeRepository;
use App\Repositories\Contracts\SchedulingRepository;
use App\Services\Contracts\SchedulingService;
use DateTime;

class SchedulingServiceV1 implements SchedulingService
{
    private SchedulingRepository $schedulingRepository;
    private CustomerRepository $customerRepository;
    private EmployeeRepository $employeeRepository;

    public function __construct(
        SchedulingRepository $schedulingRepository,
        CustomerRepository $customerRepository,
        EmployeeRepository $employeeRepository
    ) {
        $this->schedulingRepository = $schedulingRepository;
        $this->customerRepository = $customerRepository;
        $this->employeeRepository = $employeeRepository;
    }

    public function getAll(): array
    {
        return $this->schedulingRepository->getAll();
    }

    public function create(array $data)
    {
        $customer = $this->customerRepository->find($data['customerId']);
        $employee = null;

        if (!empty($data['employeeId'])) {
            $employee = $this->employeeRepository->find($data['employeeId']);
        }

        $scheduling = new Scheduling(
            null,
            $customer,
            $employee,
            new DateTime($data['startDatetime']),
            new DateTime($data['endDatetime']),
            new DateTime(),
            new DateTime(),
        );

        return $this->schedulingRepository->create($scheduling);
    }

    public function update(int $id, array $data)
    {
        $current = $this->schedulingRepository->find($id);

        $customer = $this->customerRepository->find($data['customerId']);
        $employee = null;

        if (!empty($data['employeeId'])) {
            $employee = $this->employeeRepository->find($data['employeeId']);
        }

        $scheduling = new Scheduling(
            $current->getId(),
            $customer,
            $employee,
            new DateTime($data['startDatetime']),
            new DateTime($data['endDatetime']),
            $current->getCreatedAt(),
            new DateTime(),
        );

        return $this->schedulingRepository->update($scheduling);
    }

    public function delete(int $id)
    {
        $scheduling = $this->schedulingRepository->find($id);
        $this->schedulingRepository->delete($scheduling);
    }
}