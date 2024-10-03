@extends('layouts.app')

@section('content')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-6 text-center">To-Do List</h1>

        <a href="{{ route('todos.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mb-6 inline-block hover:bg-blue-600">
            Add New To-Do
        </a>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <ul class="space-y-4">
            @foreach($todos as $todo)
                <li class="p-4 bg-white shadow-md rounded-md">
                    <strong class="text-xl">{{ $todo->title }}</strong>
                    <p class="mt-2 text-gray-600">{{ $todo->description }}</p>
                    <p class="mt-2 text-gray-500">Due Date: {{ $todo->due_date ? $todo->due_date->format('d-m-Y') : 'No due date' }}</p>
                    
                    @if($todo->image)
                        <img src="{{ asset('storage/' . $todo->image) }}" alt="{{ $todo->title }}" class="mt-4 w-32 h-auto rounded">
                    @endif
                    
                    <p class="mt-2 text-gray-500">Tags: {{ $todo->tags ?? 'No tags' }}</p>
                    <p class="mt-2 text-gray-500">Status: 
                        <span class="{{ $todo->is_completed ? 'text-green-600' : 'text-red-600' }}">
                            {{ $todo->is_completed ? 'Completed' : 'Incomplete' }}
                        </span>
                    </p>

                    <div class="flex space-x-2 mt-4">
                        <a href="{{ route('todos.edit', $todo->id) }}" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600">
                            Edit
                        </a>

                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
