<?php

namespace App\Repositories\Eloquent;

use App\Entities\Cpf;
use App\Entities\Customer;
use App\Entities\Phone;
use App\Repositories\Contracts\CustomerRepository;
use Illuminate\Support\Facades\DB;
use DateTime;

class CustomerRepositoryEloquent implements CustomerRepository
{
    public function getAll(): array
    {
        $data = DB::table('customer')->get();

        return $data->map(function($customer) {
            return new Customer(
                $customer->id,
                $customer->name,
                new Cpf($customer->cpf),
                new Phone($customer->cell_phone),
                $customer->email,
                new DateTime($customer->created_at),
                new DateTime($customer->updated_at),
            );
        })->toArray();
    }

    public function find(int $id): Customer
    {
        $customer = DB::table('customer')->find($id);
        return new Customer(
            $customer->id,
            $customer->name,
            new Cpf($customer->cpf),
            new Phone($customer->cell_phone),
            $customer->email,
            new DateTime($customer->created_at),
            new DateTime($customer->updated_at),
        );
    }

    public function create(Customer $customer): Customer
    {
        DB::table('customer')
            ->insertGetId([
                'name' => $customer->getName(),
                'cell_phone' => $customer->getCellPhone()->unformatted() ?? '',
                'email' => $customer->getEmail(),
                'cpf' => $customer->getCpf()->unformatted(),
                'created_at' => $customer->getCreatedAt()->format('Y-m-d H:i:s'),
                'updated_at' => $customer->getUpdatedAt()->format('Y-m-d H:i:s')
            ]);

        return $customer;
    }

    public function update(Customer $customer)
    {
        DB::table('customer')
            ->where('id', $customer->getId())
            ->update([
                'name' => $customer->getName(),
                'cell_phone' => $customer->getCellPhone()->unformatted() ?? '',
                'email' => $customer->getEmail(),
                'cpf' => $customer->getCpf()->unformatted(),
                'updated_at' => $customer->getUpdatedAt()
            ]);
    }

    public function delete(Customer $customer)
    {
        DB::table('customer')->delete($customer->getId());
    }
}