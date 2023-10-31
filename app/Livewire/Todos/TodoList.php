<?php

namespace App\Livewire\Todos;

use App\Models\Todo;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    public ?int $todoDelete = null;

    public function edit(int $id): void
    {
        $this->redirect(route('todos.edit', ['todo' => $id]));
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
        $this->todoDelete = $id;

        $this->dispatch('open-modal', 'confirm-todo-deletion');
    }

    #[On('delete-todo')]
    public function delete(): void
    {
        /** @var Todo $todo */
        $todo = auth()->user()->todos()->findOrFail($this->todoDelete);
        $todo->delete();
        $this->todoDelete = null;

        session()->flash('status', 'La tarea se ha eliminado correctamente');

        $this->redirect(route('todos.index'));
    }

    public function render(): Renderable
    {
        $todos = auth()->user()->todos()->paginate(10);

        return view('livewire.todos.todo-list', [
            'todos' => $todos,
        ]);
    }
}
