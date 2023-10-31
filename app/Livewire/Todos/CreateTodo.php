<?php

namespace App\Livewire\Todos;

use App\Models\Todo;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateTodo extends Component
{
    public string $title = '';

    public string $description = '';

    public bool $done = false;

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'min:3',
                'max:10',
                Rule::unique('todos', 'title')->where('user_id', auth()->id()),
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

        Todo::create($this->only(['title', 'description', 'done']));

        session()->flash('status', 'La tarea se ha creado correctamente');

        $this->redirect(route('todos.index'));
    }

    public function render(): View
    {
        return view('livewire.todos.create-todo');
    }
}
