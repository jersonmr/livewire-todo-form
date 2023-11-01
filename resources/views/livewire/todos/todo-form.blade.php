<form wire:submit="save">
    <div class="mb-4">
        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
            Título
        </label>

        <input
            wire:model="form.title"
            type="text"
            id="title"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('form.title') border-red-500 @enderror"
        />

        @error('form.title')
        <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
            Descripción
        </label>

        <textarea
            wire:model="form.description"
            id="description"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('form.description') border-red-500 @enderror"></textarea>

        @error('form.description')
        <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="done" class="block text-gray-700 text-sm font-bold mb-2">
            Completada
        </label>

        <input
            wire:model="form.done"
            type="checkbox"
            id="done"
        />
    </div>

    <button
        type="submit"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
    >
        {{ $textButton }}
    </button>
</form>
