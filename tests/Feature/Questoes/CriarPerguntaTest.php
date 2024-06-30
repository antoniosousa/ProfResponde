<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

test('deve ser capaz de criar uma nova pergunta com mais de 255 caracteres', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('pergunta.store'), [
        'pergunta' => str_repeat('*', 260) . '?',
    ]);

    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('perguntas', 1);
    assertDatabaseHas('perguntas', ['pergunta' => str_repeat('*', 260) . '?']);
});

test('deve verificar se termina com ponto de interrogação ?', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
})->todo();

test('deve ter pelo menos 10 caracteres', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
})->todo();
