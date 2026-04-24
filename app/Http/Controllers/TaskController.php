<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService,
    ) {}

    public function index(): View
    {
        $tasks = $this->taskService->list();

        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $task = $this->taskService->create($request->validated());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task criada com sucesso (#' . $task->id . ').');
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $this->taskService->update($task, $request->validated());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task atualizada com sucesso.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->taskService->delete($task);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task removida com sucesso.');
    }
}
