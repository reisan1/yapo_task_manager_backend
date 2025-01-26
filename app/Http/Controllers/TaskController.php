<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory as ValidationFactory;

class TaskController extends Controller
{
    protected $validationFactory;

    public function __construct(ValidationFactory $validationFactory)
    {
        $this->validationFactory = $validationFactory;
    }

    // Get all tasks with optional filters (completed, search)
    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->has('completed')) {
            $query->where('completed', $request->completed == 'true' ?? false);
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort_by') && in_array($request->sort_by, ['created_at', 'updated_at'])) {
            $order = $request->has('order') && in_array($request->order, ['asc', 'desc']) ? $request->order : 'desc';
            $query->orderBy($request->sort_by, $order);
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }

        return response()->json($query->get(), 200);
    }

    // Get a single task
    public function show($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task, 200);
    }

    // Create a new task
    public function store(Request $request)
    {
        $validator = $this->validationFactory->make($request->all(), [
            'name' => 'required|string|max:255',
            'completed' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $validatedData = $validator->validated();

        $task = Task::create($validatedData);
        return response()->json($task, 201);
    }

    // Update an existing task
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validator = $this->validationFactory->make($request->all(), [
            'name' => 'string|max:255',
            'completed' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $validatedData = $validator->validated();

        $task->update($validatedData);
        return response()->json($task, 200);
    }

    // Delete a task
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted'], 200);
    }
}