@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-6 inline-block">Create New Task</a>
        <ul class="space-y-4">
            @foreach ($tasks as $task)
                <li class="bg-white shadow-md rounded-lg p-4 flex items-center justify-between">
                    <a href="{{ route('tasks.show', $task) }}" class="text-lg font-semibold text-blue-600 hover:text-blue-800">{{ $task->title }}</a>
                    <div class="space-x-2">
                        <a href="{{ route('tasks.edit', $task) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection