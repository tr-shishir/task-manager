@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Task</h1>
        <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="project-filter">Filter by Project:</label>
                <select id="project-filter" class="form-control" name="project_id">
                    <option value="">All Projects</option>
                    @foreach($projects as $proj)
                        <option value="{{ $proj->id }}" {{ $task->project_id == $proj->id ? 'selected' : '' }}>
                            {{ $proj->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Task Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $task->name }}" required>
            </div>
            <div class="form-group">
                <label for="priority">Priority:</label>
                <input type="number" class="form-control" id="priority" name="priority" value="{{ $task->priority }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Task</button>
        </form>
    </div>
@endsection
