<?php

namespace App\Livewire\Todos;

use App\Models\Todo;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateTodo extends Component
{
    public string $title = '';

    public string $description = '';

    public bool $done = false;

    public function save(): void
    {
        Todo::create($this->only(['title', 'description', 'done']));

        session()->flash('status', 'La tarea se ha creado correctamente');

        $this->redirect(route('todos.index'));
    }

    public function render(): View
    {
        return view('livewire.todos.create-todo');
    }
}
