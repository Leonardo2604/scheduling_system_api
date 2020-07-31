<?php

namespace App\Repositories\Contracts;

use App\Entities\Customer;

interface CustomerRepository
{
    /**
     * @return App\Entities\Customer[]
     */
    public function getAll(): array;

    /**
     * @param int $id
     * @return App\Entities\Customer
     */
    public function find(int $id): Customer;

    /**
     * @param App\Entities\Customer $customer
     */
    public function create(Customer $customer): Customer;

    /**
     * @param App\Entities\Customer $customer
     */
    public function update(Customer $customer);

    /**
     * @param App\Entities\Customer $customer
     */
    public function delete(Customer $customer);
}