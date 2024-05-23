<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Duty;
use App\Models\User;

class DutyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Duty::all();
        $users = User::all();
        
        return view('duties.index', compact('tasks', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('duties.create', compact('users'));
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
        ]);

        $task = Duty::create([
            'assign_by' => $validated['assign_by'],
            'assign_to' => $validated['assign_to'],
            'dead_line' => $validated['dead_line'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('duties.index')->with('success', 'Task created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Retrieve the task based on the given ID
        $task = Duty::findOrFail($id);
    
        // Retrieve all users
        $users = User::all();
    
        // Pass the task and users to the view
        return view('tasks.show', compact('task', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function edit(Duty $duty)
    {
        $users = User::all(); // Fetch all users for the dropdown
        $tasks = Duty::all();
        return view('duties.edit', compact('duty', 'users'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Duty::findOrFail($id);
    
        $validated = $request->validate([
            'assign_by' => 'required|exists:users,id',
            'assign_to' => 'required|exists:users,id',
            'dead_line' => 'required|date',
            'description' => 'required|string|max:65535',
        ]);
    
        $task->update([
            'assign_by' => $validated['assign_by'],
            'assign_to' => $validated['assign_to'],
            'dead_line' => $validated['dead_line'],
            'description' => $validated['description'],
        ]);
    
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
