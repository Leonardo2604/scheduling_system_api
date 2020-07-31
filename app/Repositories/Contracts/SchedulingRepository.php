<?php

namespace App\Repositories\Contracts;

use App\Entities\Scheduling;

interface SchedulingRepository
{
    /**
     * @return App\Entities\Scheduling[]
     */
    public function getAll(): array;

    /**
     * @param int $id
     * @return App\Entities\Scheduling
     */
    public function find(int $id): Scheduling;

    /**
     * @param App\Entities\Scheduling $scheduling
     */
    public function create(Scheduling $scheduling): Scheduling;

    /**
     * @param App\Entities\Scheduling $scheduling
     */
    public function update(Scheduling $scheduling);

    /**
     * @param App\Entities\Scheduling $scheduling
     */
    public function delete(Scheduling $scheduling);
}