<x-modal name="confirm-todo-deletion" :show="$show">
    <form wire:submit="delete" class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('¿Seguro que quieres eliminar esta tarea?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Una vez que se elimine esta tarea, no se podrá recuperar.') }}
        </p>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-danger-button class="ml-3">
                {{ __('Eliminar tarea') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
