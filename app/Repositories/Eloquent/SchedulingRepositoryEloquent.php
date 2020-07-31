<?php

namespace App\Repositories\Eloquent;

use App\Entities\Cpf;
use App\Entities\Customer;
use App\Entities\Employee;
use App\Entities\Phone;
use App\Entities\Scheduling;
use App\Repositories\Contracts\SchedulingRepository;
use Illuminate\Support\Facades\DB;
use DateTime;

class SchedulingRepositoryEloquent implements SchedulingRepository
{
    public function getAll(): array
    {
        $data = DB::table('scheduling')
            ->join('customer', 'scheduling.customer_id', '=', 'customer.id')
            ->leftJoin('employee', 'scheduling.employee_id', '=', 'employee.id')
            ->select([
                'scheduling.*',
                'customer.id as customer_id',
                'customer.name as customer_name',
                'customer.cpf as customer_cpf',
                'customer.cell_phone as customer_cell_phone',
                'customer.email as customer_email',
                'customer.created_at as customer_created_at',
                'customer.updated_at as customer_updated_at',
                'employee.id as employee_id',
                'employee.name as employee_name',
                'employee.created_at as employee_created_at',
                'employee.updated_at as employee_updated_at',
            ])
            ->orderBy('scheduling.id')
            ->get();

        return $data->map(function($scheduling) {
            $customer = new Customer(
                $scheduling->customer_id,
                $scheduling->customer_name,
                new Cpf($scheduling->customer_cpf),
                new Phone($scheduling->customer_cell_phone),
                $scheduling->customer_email,
                new DateTime($scheduling->customer_created_at),
                new DateTime($scheduling->customer_updated_at),
            );

            $employee = null;

            if (!empty($scheduling->employee_id)) {
                $employee = new Employee(
                    $scheduling->employee_id,
                    $scheduling->employee_name,
                    new DateTime($scheduling->employee_created_at),
                    new DateTime($scheduling->employee_updated_at),
                );
            }

            return new Scheduling(
                $scheduling->id,
                $customer,
                $employee,
                new DateTime($scheduling->start_datetime),
                new DateTime($scheduling->end_datetime),
                new DateTime($scheduling->created_at),
                new DateTime($scheduling->updated_at),
            );
        })->toArray();
    }

    public function find(int $id): Scheduling
    {
        $scheduling = DB::table('scheduling')
            ->join('customer', 'scheduling.customer_id', '=', 'customer.id')
            ->leftJoin('employee', 'scheduling.employee_id', '=', 'employee.id')
            ->select([
                'scheduling.*',
                'customer.id as customer_id',
                'customer.name as customer_name',
                'customer.cpf as customer_cpf',
                'customer.cell_phone as customer_cell_phone',
                'customer.email as customer_email',
                'customer.created_at as customer_created_at',
                'customer.updated_at as customer_updated_at',
                'employee.id as employee_id',
                'employee.name as employee_name',
                'employee.created_at as employee_created_at',
                'employee.updated_at as employee_updated_at',
            ])
            ->where('scheduling.id', $id)
            ->first();

        $customer = new Customer(
            $scheduling->customer_id,
            $scheduling->customer_name,
            new Cpf($scheduling->customer_cpf),
            new Phone($scheduling->customer_cell_phone),
            $scheduling->customer_email,
            new DateTime($scheduling->customer_created_at),
            new DateTime($scheduling->customer_updated_at),
        );

        $employee = null;

        if (!empty($scheduling->employee)) {
            $employee = new Employee(
                $scheduling->employee_id,
                $scheduling->employee_name,
                new DateTime($scheduling->employee_created_at),
                new DateTime($scheduling->employee_updated_at),
            );
        }

        return new Scheduling(
            $scheduling->id,
            $customer,
            $employee,
            new DateTime($scheduling->start_datetime),
            new DateTime($scheduling->end_datetime),
            new DateTime($scheduling->created_at),
            new DateTime($scheduling->updated_at),
        );
    }

    public function create(Scheduling $scheduling): Scheduling
    {
        DB::table('scheduling')
            ->insertGetId([
                'customer_id' => $scheduling->getCustomer()->getId(),
                'employee_id' => $scheduling->getEmployee() ? $scheduling->getEmployee()->getId() : null,
                'scheduling_status_id' => 1,
                'start_datetime' => $scheduling->getStartDatetime()->format('Y-m-d H:i:s'),
                'end_datetime' => $scheduling->getEndDatetime()->format('Y-m-d H:i:s'),
                'created_at' => $scheduling->getCreatedAt()->format('Y-m-d H:i:s'),
                'updated_at' => $scheduling->getUpdatedAt()->format('Y-m-d H:i:s')
            ]);

        return $scheduling;
    }

    public function update(Scheduling $scheduling)
    {
        DB::table('scheduling')
            ->where('id', $scheduling->getId())
            ->update([
                'customer_id' => $scheduling->getCustomer()->getId(),
                'employee_id' => $scheduling->getEmployee() ? $scheduling->getEmployee()->getId() : null,
                'scheduling_status_id' => 1,
                'start_datetime' => $scheduling->getStartDatetime()->format('Y-m-d H:i:s'),
                'end_datetime' => $scheduling->getEndDatetime()->format('Y-m-d H:i:s'),
                'updated_at' => $scheduling->getUpdatedAt()->format('Y-m-d H:i:s')
            ]);
    }

    public function delete(Scheduling $scheduling)
    {
        DB::table('scheduling')->delete($scheduling->getId());
    }
}