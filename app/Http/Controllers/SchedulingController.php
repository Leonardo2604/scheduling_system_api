<?php

namespace App\Http\Controllers;

use App\Entities\Scheduling;
use App\Services\Contracts\SchedulingService;
use Illuminate\Http\Request;

class SchedulingController extends Controller
{
    private SchedulingService $schedulingService;

    public function __construct(SchedulingService $schedulingService)
    {
        $this->schedulingService = $schedulingService;
    }

    public function getAll()
    {
        $schedulings = array_map(function(Scheduling $scheduling) {
            return $scheduling->toArray();
        }, $this->schedulingService->getAll());

        return response()->json($schedulings);
    }

    public function create(Request $request)
    {
        $scheduling = $this->schedulingService->create($request->all());
        return response()->json($scheduling->toArray());
    }

    public function update(Request $request, int $id)
    {
        $this->schedulingService->update($id, $request->all());
        return response()->json([], 204);
    }

    public function delete(Request $request, int $id)
    {
        $this->schedulingService->delete($id);
        return response()->json([], 204);
    }
}
