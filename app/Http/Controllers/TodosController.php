<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodosController extends Controller
{
    public function index()
    {
        return Todo::where('user_id', Auth::user()->id)->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'completed' => 'required|boolean',
        ]);

        $todo = Todo::create([ 
            'user_id' => Auth::user()->id,
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

        Todo::query()->update($data);

        return response()->json('Updated', 200);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json('Başarıyla silindi', 200);
    }

}
