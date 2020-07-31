<?php

namespace App\Http\Controllers;

use App\Entities\Employee;
use App\Services\Contracts\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function getAll()
    {
        $employees = array_map(function(Employee $employee) {
            return $employee->toArray();
        }, $this->employeeService->getAll());

        return response()->json($employees);
    }

    public function create(Request $request)
    {
        $employee = $this->employeeService->create($request->all());
        return response()->json($employee->toArray());
    }

    public function update(Request $request, int $id)
    {
        $this->employeeService->update($id, $request->all());
        return response()->json([], 204);
    }

    public function delete(Request $request, int $id)
    {
        $this->employeeService->delete($id);
        return response()->json([], 204);
    }
}
