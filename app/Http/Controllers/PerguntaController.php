<?php

namespace App\Http\Controllers;

use App\Models\{Pergunta};
use App\Rules\PontoDeInterrogacao;
use Illuminate\Http\{RedirectResponse};
use Illuminate\View\View;

class PerguntaController extends Controller
{
    public function store(): RedirectResponse
    {
        $atributos = request()->validate([
            'pergunta' => ['required', 'min:10', new PontoDeInterrogacao()],
        ]);

        auth()->user()->perguntas()->create($atributos);

        return back();
    }

    public function publicar(Pergunta $pergunta): RedirectResponse
    {
        $user = auth()->user();

        if($user->cannot('publicar', $pergunta)) {
            abort(403);
        }

        $pergunta->update(['publicada' => true]);

        return back();
    }

    public function minhasPerguntas(Pergunta $pergunta): View
    {
        $user = auth()->user();

        return view('perguntas.minhasPerguntas', [
            'perguntas' => $user->perguntas,
        ]);
    }
}
