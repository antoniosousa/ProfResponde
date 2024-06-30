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
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('pergunta.store'), [
        'pergunta' => str_repeat('*', 10),
    ]);

    $request->assertSessionHasErrors([
        'pergunta' => 'Tem certeza de que é uma pergunta? Está faltando o ponto de interrogação no final!',
    ]);
    assertDatabaseCount('perguntas', 0);
});

test('deve ter pelo menos 10 caracteres', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('pergunta.store'), [
        'pergunta' => str_repeat('*', 8) . '?',
    ]);

    $request->assertSessionHasErrors(['pergunta' => __('validation.min.string', ['min' => 10, 'attribute' => 'pergunta'])]);
    assertDatabaseCount('perguntas', 0);
});
