<?php

test('todo list component renders', function () {
    $user = \App\Models\User::factory()->create();

    Livewire::actingAs(\App\Models\User::factory()->create())
        ->test(\App\Livewire\Todos\TodoList::class)
        ->assertSee('No hay tareas');
});

test('todo list component renders with todos', function () {
    $user = \App\Models\User::factory()->create();

    $action = Livewire::actingAs($user);

    $user->todos()->create([
        'title' => 'Comprar pan',
        'description' => 'Ir a la panadería y comprar pan',
        'done' => false,
    ]);

    $action->test(\App\Livewire\Todos\TodoList::class)
        ->assertSee('Comprar pan')
        ->assertSee('Ir a la panadería y comprar pan');
});

test('todo list pagination works', function () {
    $user = \App\Models\User::factory()->create();

    $action = Livewire::actingAs($user);

    $user->todos()->createMany(
        collect(range(1, 20))->map(fn ($i) => [
            'title' => "Comprar pan {$i}",
        ])->toArray(),
    );

    $action->test(\App\Livewire\Todos\TodoList::class)
        ->assertSee('Comprar pan 1')
        ->assertSee('Comprar pan 10')
        ->assertDontSee('Comprar pan 11')
        ->call('nextPage')
        ->assertSee('Comprar pan 11')
        ->assertDontSee('Comprar pan 10')
        ->call('previousPage')
        ->assertSee('Comprar pan 10')
        ->assertDontSee('Comprar pan 11');
});

test('todo list component toggles todo', function () {
    $user = \App\Models\User::factory()->create();

    $action = Livewire::actingAs($user);

    $todo = $user->todos()->create([
        'title' => 'Comprar pan',
        'description' => 'Ir a la panadería y comprar pan',
        'done' => false,
    ]);

    $action->test(\App\Livewire\Todos\TodoList::class)
        ->assertSee('Comprar pan')
        ->assertSee('Ir a la panadería y comprar pan')
        ->assertSee('Marcar como completada')
        ->call('toggle', $todo->id)
        ->assertDontSee('Marcar como completada')
        ->assertSee('Marcar como no completada');
});

test('todo list component deletes todo', function () {
    $user = \App\Models\User::factory()->create();

    $action = Livewire::actingAs($user);

    $todo = $user->todos()->create([
        'title' => 'Comprar pan',
        'description' => 'Ir a la panadería y comprar pan',
        'done' => false,
    ]);

    $action->test(\App\Livewire\Todos\TodoList::class)
        ->assertSee('Comprar pan')
        ->assertSee('Ir a la panadería y comprar pan')
        ->call('preDelete', $todo->id)
        ->assertDispatched('open-modal', 'confirm-todo-deletion')
        ->dispatch('delete-todo')
        ->assertRedirect(route('todos.index'));

    $this->assertModelMissing($todo);
});
