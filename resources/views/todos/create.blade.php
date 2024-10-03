@extends('layouts.app')

@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<a href="{{ route('dashboard') }}" class="bg-gray-500 text-white font-bold py-2 px-4 rounded mb-6 inline-block hover:bg-gray-600">
    Regresar a la página principal
</a>
<div class="max-w-lg mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg border border-gray-200">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Create a New To-Do</h1>

    <div class="mb-6 text-center">
       
         
    </div>
    
    <form action="{{ route('todos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-w-md mx-auto">
        @csrf

        <div class="flex flex-col">
            <label for="title" class="text-sm font-semibold mb-1 text-gray-600">Title:</label>
            <input type="text" name="title" id="title" class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200" required>
        </div>

        <div class="flex flex-col">
            <label for="description" class="text-sm font-semibold mb-1 text-gray-600">Description:</label>
            <textarea name="description" id="description" rows="4" class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200" required></textarea>
        </div>

        <div class="flex flex-col">
            <label for="due_date" class="text-sm font-semibold mb-1 text-gray-600">Due Date:</label>
            <input type="date" name="due_date" id="due_date" class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200">
        </div>

        <div class="flex flex-col">
            <label for="tags" class="text-sm font-semibold mb-1 text-gray-600">Tags:</label>
            <input type="text" name="tags" id="tags" class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200">
        </div>

        <div class="flex flex-col">
            <label for="image" class="text-sm font-semibold mb-1 text-gray-600">Image:</label>
            <input type="file" name="image" id="image" class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200">
        </div>

        <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300 w-full">
            Create To-Do
        </button>
    </form>

    {{-- Mostrar la fecha de vencimiento si existe --}}
    @if(isset($todo))
        <div class="mt-6">
            <h2 class="text-xl font-bold text-gray-800">To-Do Details</h2>
            <p class="mt-2 text-gray-500">Due Date: {{ $todo->due_date ? \Carbon\Carbon::parse($todo->due_date)->format('d-m-Y') : 'No due date' }}</p>
        </div>
    @endif
</div>
@endsection
