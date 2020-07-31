<?php

namespace App\Entities;

use DateTime;

class Scheduling
{
    private ?int $id;
    private Customer $customer;
    private ?Employee $employee;
    private DateTime $startDatetime;
    private DateTime $endDatetime;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(
        ?int $id,
        Customer $customer,
        ?Employee $employee,
        DateTime $startDatetime,
        DateTime $endDatetime,
        DateTime $createdAt,
        DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->customer = $customer;
        $this->employee = $employee;
        $this->startDatetime = $startDatetime;
        $this->endDatetime = $endDatetime;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function getStartDatetime(): DateTime
    {
        return $this->startDatetime;
    }

    public function getEndDatetime(): DateTime
    {
        return $this->endDatetime;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'customer' => $this->customer->toArray(),
            'employee' => $this->employee ? $this->employee->toArray() : null,
            'startDatetime' => $this->startDatetime->format('Y-m-d H:i:s'),
            'endDatetime' => $this->endDatetime->format('Y-m-d H:i:s'),
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
        ];
    }
}