<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Todo extends Model
{
     
    protected $fillable = ['title', 'description', 'is_completed', 'user_id', 'due_date'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

     
    public function getDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }
}
