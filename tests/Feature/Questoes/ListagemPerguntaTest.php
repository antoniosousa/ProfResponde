<?php

use App\Models\{Pergunta, User};

use function Pest\Laravel\{actingAs, get};

test('Deve listar todas as perguntas feitas da disciplina', function () {
    $user = User::factory()->create();

    $perguntas = Pergunta::factory()->count(15)->create();

    actingAs($user);

    $response = get(route('dashboard'));

    /** @var Pergunta $p */
    foreach ($perguntas as $p) {
        $response->assertSee($p->pergunta);
    }
});
