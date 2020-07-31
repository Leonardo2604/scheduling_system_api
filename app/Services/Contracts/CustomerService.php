<?php

namespace App\Services\Contracts;

interface CustomerService
{
    /**
     * @return \App\Entities\Customer[]
     */
    public function getAll(): array;

    /**
     * @param array $data
     */
    public function create(array $data);

    /**
     * @param array $data
     */
    public function update(int $id, array $data);

    /**
     * @param array $data
     */
    public function delete(int $id);
}