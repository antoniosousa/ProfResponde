<?php

namespace App\Http\Controllers;

use App\Models\Pergunta;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'perguntas' => Pergunta::all(),
        ]);
    }
}
