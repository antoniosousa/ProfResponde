<?php

use App\Http\Controllers\{DashboardController, PerguntaController, ProfileController, VotoController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(app()->isLocal()) {
        auth()->loginUsingId(1);

        return to_route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/pergunta/store', [PerguntaController::class, 'store'])->name('pergunta.store');
    Route::post('/{pergunta}/votar', VotoController::class)->name('votar');
    Route::put('/{pergunta}/publicar', [PerguntaController::class, 'publicar'])->name('pergunta.publicar');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
