@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white py-4 px-6">
                <h2 class="text-2xl font-bold">Task Details</h2>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Title:</h3>
                    <p class="text-gray-600">{{ $task->title }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Description:</h3>
                    <p class="text-gray-600">{{ $task->description }}</p>
                </div>
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">Edit Task</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" onclick="return confirm('Are you sure you want to delete this task?')">Delete Task</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="mt-4 text-center">
            <a href="{{ route('tasks.index') }}" class="inline-block bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">Back to Task List</a>
        </div>
    </div>
</div>
@endsection