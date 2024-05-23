<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');
    
        $tasks = Task::query()
            ->whereHas('assigner', function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('assignee', function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orWhere('description', 'like', "%{$search}%")
            ->orderBy($sort, $direction)
            ->paginate(5);
    
        $users = User::all();
    
        return view('tasks.index', compact('tasks', 'users'));
    }
    
    
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'assign_by' => 'required|exists:users,id',
            'assign_to' => 'required|exists:users,id',
            'dead_line' => 'required|date',
            'description' => 'required|string|max:65535',
            'status' => 'required|in:complete,incomplete',
        ]);

        $task = Task::create([
            'assign_by' => $validated['assign_by'],
            'assign_to' => $validated['assign_to'],
            'dead_line' => $validated['dead_line'],
            'description' => $validated['description'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Retrieve the task based on the given ID
        $task = Task::findOrFail($id);
    
        // Retrieve all users
        $users = User::all();
    
        // Pass the task and users to the view
        return view('tasks.show', compact('task', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $users = User::all(); // Fetch all users for the dropdown
        $tasks = Task::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
    
        $validated = $request->validate([
            'assign_by' => 'required|exists:users,id',
            'assign_to' => 'required|exists:users,id',
            'dead_line' => 'required|date',
            'description' => 'required|string|max:65535',
            'status' => 'required|in:complete,incomplete',
        ]);
    
        $task->update([
            'assign_by' => $validated['assign_by'],
            'assign_to' => $validated['assign_to'],
            'dead_line' => $validated['dead_line'],
            'description' => $validated['description'],
            'status' => $validated['status'],
        ]);
    
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the resource by its ID
        $task = Task::findOrFail($id);
        
        // Delete the resource
        $task->delete();
    
        // Redirect back with a success message
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
    
}
