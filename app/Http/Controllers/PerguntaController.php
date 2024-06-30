<?php

namespace App\Http\Controllers;

use App\Models\Pergunta;
use App\Rules\PontoDeInterrogacao;
use Illuminate\Http\{RedirectResponse};

class PerguntaController extends Controller
{
    public function store(): RedirectResponse
    {
        $atibutos = request()->validate([
            'pergunta' => ['required', 'min:10', new PontoDeInterrogacao()],
        ]);
        Pergunta::query()->create($atibutos);

        return to_route('dashboard');
    }
}
