<?php

namespace App\Services\V1;

use App\Entities\Cpf;
use App\Entities\Customer;
use App\Entities\Phone;
use App\Repositories\Contracts\CustomerRepository;
use App\Services\Contracts\CustomerService;
use DateTime;

class CustomerServiceV1 implements CustomerService
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAll(): array
    {
        return $this->customerRepository->getAll();
    }

    public function create(array $data)
    {
        $customer = new Customer(
            null,
            $data['name'],
            new Cpf($data['cpf']),
            new Phone($data['cellPhone']),
            $data['email'],
            new DateTime(),
            new DateTime()
        );

        return $this->customerRepository->create($customer);
    }

    public function update(int $id, array $data)
    {
        $current = $this->customerRepository->find($id);
        $customer = new Customer(
            $current->getId(),
            $data['name'],
            new Cpf($data['cpf']),
            new Phone($data['cellPhone']),
            $data['email'],
            $current->getCreatedAt(),
            new DateTime()
        );

        return $this->customerRepository->update($customer);
    }

    public function delete(int $id)
    {
        $customer = $this->customerRepository->find($id);
        $this->customerRepository->delete($customer);
    }
}