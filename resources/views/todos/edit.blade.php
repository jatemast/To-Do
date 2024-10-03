@extends('layouts.app')

@section('content')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <div class="max-w-lg mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4 text-center text-gray-800">Edit To-Do</h1>

        <form action="{{ route('todos.update', $todo->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="flex flex-col">
                <label for="title" class="text-sm font-semibold mb-1 text-gray-600">Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $todo->title) }}" class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div class="flex flex-col">
                <label for="description" class="text-sm font-semibold mb-1 text-gray-600">Description:</label>
                <textarea name="description" id="description" rows="3" class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ old('description', $todo->description) }}</textarea>
            </div>

            <div class="flex flex-col">
                <label for="due_date" class="text-sm font-semibold mb-1 text-gray-600">Due Date:</label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $todo->due_date ? $todo->due_date->format('Y-m-d') : '') }}" class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="flex flex-col">
                <label for="tags" class="text-sm font-semibold mb-1 text-gray-600">Tags:</label>
                <input type="text" name="tags" id="tags" value="{{ old('tags', $todo->tags) }}" class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="flex flex-col">
                <label for="image" class="text-sm font-semibold mb-1 text-gray-600">Image:</label>
                <input type="file" name="image" id="image" class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                @if($todo->image)
                    <img src="{{ asset('storage/' . $todo->image) }}" alt="{{ $todo->title }}" class="mt-4 w-32 h-auto rounded">
                @endif
            </div>

            <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300 w-full">
                Update To-Do
            </button>
        </form>
    </div>
@endsection
