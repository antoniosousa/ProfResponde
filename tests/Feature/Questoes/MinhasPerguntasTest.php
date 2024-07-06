<?php

use App\Models\{Pergunta, User};

use function Pest\Laravel\{actingAs, get};

test('deve ser capaz de listar todas as questões criadas por mim', function () {
    $userDono      = User::factory()->create();
    $perguntasDono = Pergunta::factory()->count(10)->create(['user_id' => $userDono->id]);

    $userVisitante      = User::factory()->create();
    $perguntasVisitante = Pergunta::factory()->count(10)->create(['user_id' => $userVisitante->id]);

    actingAs($userVisitante);

    $response = get(route('minhas.perguntas'));

    foreach ($perguntasVisitante as $perguntaV) {
        $response->assertSee($perguntaV->pergunta);
    }

    foreach ($perguntasDono as $perguntaD) {
        $response->assertDontSee($perguntaD->pergunta);
    }

});
