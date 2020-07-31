<?php

namespace App\Services\Contracts;

interface SchedulingService
{
    /**
     * @return \App\Entities\Scheduling[]
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