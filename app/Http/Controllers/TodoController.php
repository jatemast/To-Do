<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Todo;

class TodoController extends Controller
{
    
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
            'tags' => 'nullable|string',
        ]);
    
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->is_completed = false;
        $todo->user_id = auth()->id();
        
        // Asegúrate de que `due_date` se almacene como un objeto `Carbon`
        if ($request->due_date) {
            $todo->due_date = \Carbon\Carbon::createFromFormat('Y-m-d', $request->due_date);
        } else {
            $todo->due_date = null; // O puedes decidir no guardar nada
        }
    
        // Manejo de carga de imágenes
        if ($request->hasFile('image')) {
            $todo->image = $request->file('image')->store('images', 'public');
        }
    
        $todo->save();
    
        return redirect()->route('todos.index')->with('success', 'To-Do created successfully.');
    }
    
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }
    // Update an existing To-Do
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'is_completed' => 'nullable|boolean',
            'due_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
            'tags' => 'nullable|string',
        ]);

        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->is_completed = $request->has('is_completed');
        $todo->due_date = $request->due_date;

        if ($request->hasFile('image')) {
            $todo->image = $request->file('image')->store('images', 'public');
        }

        $todo->save();

        return redirect()->route('todos.index')->with('success', 'To-Do updated successfully.');
    }

    // Delete a To-Do
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'To-Do deleted successfully.');
    }
}

