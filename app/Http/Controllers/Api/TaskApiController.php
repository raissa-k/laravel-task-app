<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskApiController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService,
    ) {}

    public function index(): JsonResponse
    {
        $tasks = $this->taskService->list();

        return response()->json([
            'ok' => true,
            'count' => $tasks->count(),
            'data' => $tasks,
        ]);
    }

    public function show(Task $task): JsonResponse
    {
        return response()->json([
            'ok' => true,
            'data' => $task,
        ]);
    }
}
