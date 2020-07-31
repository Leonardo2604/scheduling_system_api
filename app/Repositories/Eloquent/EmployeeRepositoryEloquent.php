<?php

namespace App\Repositories\Eloquent;

use App\Entities\Employee;
use App\Repositories\Contracts\EmployeeRepository;
use Illuminate\Support\Facades\DB;
use DateTime;

class EmployeeRepositoryEloquent implements EmployeeRepository
{
    public function getAll(): array
    {
        $data = DB::table('employee')->get();

        return $data->map(function($employee) {
            return new Employee(
                $employee->id,
                $employee->name,
                new DateTime($employee->created_at),
                new DateTime($employee->updated_at),
            );
        })->toArray();
    }

    public function find(int $id): Employee
    {
        $employee = DB::table('employee')->find($id);
        return new Employee(
            $employee->id,
            $employee->name,
            new DateTime($employee->created_at),
            new DateTime($employee->updated_at),
        );
    }

    public function create(Employee $employee): Employee
    {
        DB::table('employee')
            ->insertGetId([
                'name' => $employee->getName(),
                'created_at' => $employee->getCreatedAt()->format('Y-m-d H:i:s'),
                'updated_at' => $employee->getUpdatedAt()->format('Y-m-d H:i:s')
            ]);

        return $employee;
    }

    public function update(Employee $employee)
    {
        DB::table('employee')
            ->where('id', $employee->getId())
            ->update([
                'name' => $employee->getName(),
                'updated_at' => $employee->getUpdatedAt()->format('Y-m-d H:i:s')
            ]);
    }

    public function delete(Employee $employee)
    {
        DB::table('employee')->delete($employee->getId());
    }
}