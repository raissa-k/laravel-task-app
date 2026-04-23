<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskApiController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = Task::query()->orderByDesc('id')->get();

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
