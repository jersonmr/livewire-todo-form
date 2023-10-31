<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Contracts\View\View;

class TodoController extends Controller
{
    public function index(): View
    {
        return view('todos.index');
    }

    public function create(): View
    {
        return view('todos.create');
    }

    public function edit(Todo $todo): View
    {
        return view('todos.edit', compact('todo'));
    }
}
