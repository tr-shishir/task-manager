<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        $tasks = Task::orderBy('priority')
            ->get();

        $projects = Project::all();

        return view('tasks.index', compact('project', 'tasks', 'projects'));
    }

    public function create()
    {
        $projects = Project::all();
        $priority = Task::latest()->first()->priority + 1;

        return view('tasks.create', compact('projects', 'priority'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'priority' => 'required|integer',
            'project_id' => 'required|integer',
        ]);

        Task::create($data);

        return redirect()->route('tasks.index');
    }

    public function edit(Project $project, Task $task)
    {
        $projects = Project::all();
        return view('tasks.edit', compact('project', 'task', 'projects'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'priority' => 'required|integer',
            'project_id' => 'required|integer',
        ]);

        $task->update($data);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function reorder(Request $request)
    {
        $taskIds = $request->input('taskIds');
        $priority = 1;

        foreach ($taskIds as $taskId) {
            $task = Task::find($taskId);
            if ($task) {
                $task->priority = $priority++;
                $task->save();
            }
        }

        return response()->json(['message' => 'Tasks reordered successfully']);
    }

}
