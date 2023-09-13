@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tasks for {{ $project->name }}</h1>

        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>
        <a href="{{ route('projects.index') }}" class="btn btn-primary mb-3">Projects</a>

        <div class="form-group">
            <label for="project-filter">Filter by Project:</label>
            <select id="project-filter" class="form-control">
                <option value="">All Projects</option>
                @foreach($projects as $proj)
                    <option value="{{ $proj->id }}" {{ $project->id == $proj->id ? 'selected' : '' }}>
                        {{ $proj->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Task List --}}
        <ul id="task-list" class="list-group">
            @foreach($tasks as $task)
                <li class="list-group-item" data-task-id="{{ $task->id }}" data-project-id="{{ $task->project_id }}">
                    <span class="task-priority">{{ $task->priority }}</span>
                    {{ $task->name }}
                    <div class="task-actions">
                        <a href="{{ route('tasks.edit', ['project' => $project->id, 'task' => $task->id]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('tasks.destroy', ['project' => $project->id, 'task' => $task->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- JavaScript for Task Reordering --}}
    <script>
        $(document).ready(function() {
            // Initialize sortable for the task list
            $("#task-list").sortable({
                update: function(event, ui) {
                    var taskIds = [];
                    $("#task-list li").each(function() {
                        taskIds.push($(this).data('task-id'));
                    });

                    // Send an AJAX request to update task priorities
                    $.ajax({
                        url: "{{ route('tasks.reorder') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            taskIds: taskIds
                        },
                        success: function(response) {
                            console.log(response.message);
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                }
            });

            // Filter tasks by selected project
            $("#project-filter").change(function() {
                var selectedProjectId = $(this).val();
                if (selectedProjectId !== "") {
                    $("#task-list li").hide();
                    $("#task-list li[data-project-id='" + selectedProjectId + "']").show();
                } else {
                    $("#task-list li").show();
                }
            });
        });
    </script>
@endsection
