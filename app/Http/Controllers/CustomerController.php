<?php

namespace App\Http\Controllers;

use App\Entities\Customer;
use App\Services\Contracts\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function getAll()
    {
        $customers = array_map(function(Customer $customer) {
            return $customer->toArray();
        }, $this->customerService->getAll());

        return response()->json($customers);
    }

    public function create(Request $request)
    {
        $customer = $this->customerService->create($request->all());
        return response()->json($customer->toArray());
    }

    public function update(Request $request, int $id)
    {
        $this->customerService->update($id, $request->all());
        return response()->json([], 204);
    }

    public function delete(Request $request, int $id)
    {
        $this->customerService->delete($id);
        return response()->json([], 204);
    }
}
