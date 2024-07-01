<?php

use App\Models\{Pergunta, User};

use function Pest\Laravel\{actingAs, put};

test('deve ser possível publicar uma pergunta enquanto estiver como rascunho', function () {
    $user = User::factory()->create();
    actingAs($user);

    $pergunta = pergunta::factory()->create();

    put(route('pergunta.publicar', $pergunta))
    ->assertRedirect();

    $pergunta->refresh();

    expect($pergunta)->publicada->toBeTrue();
});
