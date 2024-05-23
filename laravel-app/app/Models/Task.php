<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'assign_by',
        'assign_to',
        'dead_line',
        'description',
        'status',
        
    ];

    // Define relationships
    public function assigner()
    {
        return $this->belongsTo(User::class, 'assign_by');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }
}
