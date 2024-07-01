<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Pergunta extends Model
{
    use HasFactory;

    protected $casts = [
        'publicada' => 'boolean',
    ];

    public function votos(): HasMany
    {
        return $this->hasMany(Voto::class);
    }

    public function totalVotos(): int
    {
        return $this->votos()->sum('voto');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
