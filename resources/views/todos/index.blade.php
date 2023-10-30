<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de tareas') }}
        </h2>

        <br>

        <a href="{{ route('todos.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">{{ __('Crear tarea') }}</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(session('status'))
                    <div class="bg-green-500 text-white p-4 mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="p-6 text-gray-900">
                    <livewire:todos.todo-list />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
