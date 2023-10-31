<?php

namespace App\Livewire\Todos;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ConfirmTodoDeletion extends Component
{
    public bool $show = false;

    public function delete(): void
    {
        $this->dispatch('delete-todo')->to(TodoList::class);
    }

    public function render(): View
    {
        return view('livewire.todos.confirm-todo-deletion');
    }
}
