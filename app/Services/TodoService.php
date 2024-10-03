<?php

namespace App\Services;

use App\Models\Todo;
use Carbon\Carbon;

class TodoService
{
    public function createTodo($data)
    {
        $todo = new Todo();
        $todo->title = $data['title'];
        $todo->description = $data['description'];
        $todo->is_completed = false;
        $todo->user_id = auth()->id();
        
        if (isset($data['due_date'])) {
            $todo->due_date = Carbon::createFromFormat('Y-m-d', $data['due_date']);
        } else {
            $todo->due_date = null;
        }

        if (isset($data['image'])) {
            $todo->image = $data['image']->store('images', 'public');
        }
        
        $todo->save();

        return $todo;
    }

    public function updateTodo(Todo $todo, $data)
    {
        $todo->title = $data['title'];
        $todo->description = $data['description'];
        $todo->is_completed = isset($data['is_completed']);
        $todo->due_date = $data['due_date'];

        if (isset($data['image'])) {
            $todo->image = $data['image']->store('images', 'public');
        }

        $todo->save();
    }

    public function deleteTodo(Todo $todo)
    {
        $todo->delete();
    }
}
