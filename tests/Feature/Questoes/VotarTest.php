<?php

use App\Models\{Pergunta, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, get, post};

test('deve ser possível votar em dúvidas', function () {
    $user = User::factory()->create();
    actingAs($user);

    $pergunta = Pergunta::factory()->create();

    post(route('votar', $pergunta))->assertRedirect();

    assertDatabaseHas('votos', [
        'pergunta_id' => $pergunta->id,
        'user_id'     => $user->id,
        'voto'        => 1,
    ]);
});

test('deve ser possível retirar o voto já registrado em dúvidas', function () {
    $user = User::factory()->create();
    actingAs($user);

    $pergunta = Pergunta::factory()->create();

    post(route('votar', $pergunta));
    post(route('votar', $pergunta));

    assertDatabaseHas('votos', [
        'pergunta_id' => $pergunta->id,
        'user_id'     => $user->id,
        'voto'        => 0,
    ]);
    assertDatabaseCount('votos', 1);
});

test('deve conter o total de votos na página', function () {
    $user = User::factory()->create();
    actingAs($user);

    $perguntas = Pergunta::factory()->count(15)->create();

    post(route('votar', $perguntas->first()->id));

    $response = get(route('dashboard'));

    /** @var Pergunta $p */
    foreach ($perguntas as $p) {
        $response->assertSee($p->totalVotos());
    }
});
