<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(): View
    {
        return view('todos.index');
    }

    public function store(Request $request)
    {
        $request->validate([

        ]);

        return Todo::create($request->validated());
    }

    public function show(Todo $todo)
    {
        return $todo;
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([

        ]);

        $todo->update($request->validated());

        return $todo;
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json();
    }
}
