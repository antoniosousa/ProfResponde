<?php

namespace App\Http\Controllers;

use App\Models\{Pergunta};
use Illuminate\Http\RedirectResponse;

class VotoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Pergunta $pergunta): RedirectResponse
    {
        auth()->user()->votar($pergunta);

        return back();
    }
}
