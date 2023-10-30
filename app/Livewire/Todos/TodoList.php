<?php

namespace App\Livewire\Todos;

use App\Models\Todo;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    public ?int $todoDelete = null;

    public function edit(int $id): void
    {

    }

    public function toggle(int $id): void
    {
        /** @var Todo $todo */
        $todo = auth()->user()->todos()->findOrFail($id);

        $todo->done = ! $todo->done;

        $todo->save();
    }

    public function preDelete(int $id): void
    {

    }

    public function delete(): void
    {

    }

    public function render(): Renderable
    {
        $todos = auth()->user()->todos()->paginate(10);

        return view('livewire.todos.todo-list', [
            'todos' => $todos,
        ]);
    }
}
