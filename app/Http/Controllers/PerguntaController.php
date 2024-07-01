<?php

namespace App\Http\Controllers;

use App\Models\Pergunta;
use App\Rules\PontoDeInterrogacao;
use Illuminate\Http\{RedirectResponse};

class PerguntaController extends Controller
{
    public function store(): RedirectResponse
    {
        $atributos = request()->validate([
            'pergunta' => ['required', 'min:10', new PontoDeInterrogacao()],
        ]);
        Pergunta::query()->create($atributos);

        return to_route('dashboard');
    }

    public function publicar(Pergunta $pergunta): RedirectResponse
    {
        $pergunta->update(['publicada' => true]);

        return back();
    }
}
