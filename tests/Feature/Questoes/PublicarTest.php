<?php

use App\Models\{Pergunta, User};

use function Pest\Laravel\{actingAs, put};

test('deve ser possível publicar uma pergunta enquanto estiver como rascunho', function () {
    $user = User::factory()->create();
    actingAs($user);

    $pergunta = pergunta::factory()->create(['user_id' => $user->id]);

    put(route('pergunta.publicar', $pergunta))
    ->assertRedirect();

    $pergunta->refresh();

    expect($pergunta)->publicada->toBeTrue();
});

test('apenas quem criou a pergunta em rascunho pode publicar', function () {
    $userDono       = User::factory()->create();
    $userObservador = User::factory()->create();

    actingAs($userObservador);

    $pergunta = pergunta::factory()->create(['user_id' => $userDono->id]);

    put(route('pergunta.publicar', $pergunta))
        ->assertForbidden();
});
