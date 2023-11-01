<?php

namespace App\Livewire\Todos;

use App\Livewire\Forms\Todos\TodoForm;
use App\Models\Todo;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class UpdateTodo extends Component
{
    public Todo $todo;

    public TodoForm $form;

    public function mount(Todo $todo): void
    {
        $this->todo = $todo;
        $this->form->setTodo($todo);
    }

    public function save(): void
    {
        $this->validate();

        $this->form->update();

        session()->flash('status', 'La tarea ha sido actualizada');

        $this->redirect(route('todos.index'));
    }

    public function render(): Renderable
    {
        return view('livewire.todos.todo-form', [
            'textButton' => __('Actualizar'),
        ]);
    }
}
