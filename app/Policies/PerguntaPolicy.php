<?php

namespace App\Policies;

use App\Models\{Pergunta, User};

class PerguntaPolicy
{
    public function publicar(User $user, Pergunta $pergunta): bool
    {
        return $pergunta->user->is($user);
    }
}
