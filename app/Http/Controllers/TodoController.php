<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Todo;
use App\Services\TodoService;  

class TodoController extends Controller
{
    
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    // List all To-Dos
    public function index()
    {
        $todos = Todo::where('user_id', auth()->id())->get();
        return view('todos.index', compact('todos'));
    }

    // Show the form for creating a new To-Do
    public function create()
    {
        return view('todos.create');
    }

    // Store a new To-Do
    public function store(StoreTodoRequest $request)
    {
        $data = $request->validated();
        $this->todoService->createTodo($data);  

        return redirect()->route('todos.index')->with('success', 'To-Do created successfully.');
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    // Update an existing To-Do
    public function update(StoreTodoRequest $request, Todo $todo)
    {
       

        $this->todoService->updateTodo($todo, $request->all());  

        return redirect()->route('todos.index')->with('success', 'To-Do updated successfully.');
    }

    
    public function destroy(Todo $todo)
    {
        $this->todoService->deleteTodo($todo);  
        return redirect()->route('todos.index')->with('success', 'To-Do deleted successfully.');
    }

}

