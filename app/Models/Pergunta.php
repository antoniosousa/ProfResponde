<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pergunta extends Model
{
    use HasFactory;

    public function votos(): HasMany
    {
        return $this->hasMany(Voto::class);
    }

    public function totalVotos(): int
    {
        return $this->votos()->sum('voto');
    }
}
