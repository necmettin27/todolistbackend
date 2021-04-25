<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    public function index()
    {
        return Todo::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'completed' => 'required|boolean',
        ]);

        $todo = Todo::create([ 
            'title' => $request->title,
            'completed' => $request->completed,
        ]);

        return response($todo, 201);
    }


    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'completed' => 'required|boolean',
        ]);

        $todo->update($data);
        return response($todo, 200);
    }

    public function updateAll(Request $request)
    {
        $data = $request->validate([
            'completed' => 'required|boolean',
        ]);

        Todo::where('user_id', auth()->user()->id)->update($data);

        return response()->json('Updated', 200);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json('Başarıyla silindi', 200);
    }

    public function destroyCompleted(Request $request)
    {
        // [6,9] todo ids we are passing in and want to delete
        // [5,6,9] all of the users todo ids

        $todosToDelete = $request->todos;

        $userTodoIds = auth()->user()->todos->map(function ($todo) {
            return $todo->id;
        });

        $valid = collect($todosToDelete)->every(function ($value, $key) use ($userTodoIds) {
            return $userTodoIds->contains($value);
        });

        if (!$valid) {
            return response()->json('Unauthorized', 401);
        }

        $request->validate([
            'todos' => 'required|array',
        ]);

        Todo::destroy($request->todos);

        return response()->json('Deleted', 200);
    }
}
