<?php

namespace App\Livewire\Todos;

use App\Models\Todo;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateTodo extends Component
{
    public Todo $todo;

    public string $title = '';

    public string $description = '';

    public bool $done = false;

    public function mount(Todo $todo): void
    {
        $this->todo = $todo;

        $this->title = $todo->title;
        $this->description = $todo->description;
        $this->done = $todo->done;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'min:3',
                'max:10',
                Rule::unique('todos', 'title')
                    ->where('user_id', auth()->id())
                    ->ignore($this->todo->id),
            ],
            'description' => [
                'required',
                'min:3',
                'max:100',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El título es requerido',
            'title.min' => 'El título debe tener al menos :min caracteres',
            'title.max' => 'El título debe tener como máximo :max caracteres',
            'title.unique' => 'El título ya existe',
            'description.required' => 'La descripción es requerida',
            'description.min' => 'La descripción debe tener al menos :min caracteres',
            'description.max' => 'La descripción debe tener como máximo :max caracteres',
        ];
    }

    public function save(): void
    {
        $this->validate();

        $this->todo->update($this->only(['title', 'description', 'done']));

        session()->flash('status', 'La tarea ha sido actualizada');

        $this->redirect(route('todos.index'));
    }

    public function render(): Renderable
    {
        return view('livewire.todos.update-todo');
    }
}
