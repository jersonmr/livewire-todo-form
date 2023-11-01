<?php

namespace App\Livewire\Forms\Todos;

use App\Models\Todo;
use Illuminate\Validation\Rule;
use Livewire\Form;

class TodoForm extends Form
{
    public ?Todo $todo = null;

    public string $title = '';

    public string $description = '';

    public bool $done = false;

    public function setTodo(Todo $todo): void
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
                    ->when($this->todo, fn ($query) => $query->ignore($this->todo->id)),
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

    public function create(): void
    {
        Todo::create($this->only(['title', 'description', 'done']));
    }

    public function update(): void
    {
        $this->todo->update($this->only(['title', 'description', 'done']));
    }
}
