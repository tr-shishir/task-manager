@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Task</h1>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="project-filter">Filter by Project:</label>
                <select id="project-filter" class="form-control" name="project_id" required>
                    <option value="">All Projects</option>
                    @foreach($projects as $proj)
                        <option value="{{ $proj->id }}">
                            {{ $proj->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Task Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="priority">Priority:</label>
                <input type="number" class="form-control" id="priority" name="priority" value="{{$priority}}" min="{{$priority}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Task</button>
        </form>
    </div>
@endsection
