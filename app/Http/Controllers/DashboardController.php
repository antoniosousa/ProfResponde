<?php

namespace App\Http\Controllers;

use App\Models\Pergunta;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $userId = auth()->user()->id;

        return view('dashboard', [
            'perguntas' => Pergunta::withSum('votos', 'voto')
                ->withCount([
                    'votos as votos_count' => function ($query) use ($userId) {
                        $query->where('user_id', $userId)->where('voto', 1);
                    },
                ])
                ->get(),
        ]);
    }
}
