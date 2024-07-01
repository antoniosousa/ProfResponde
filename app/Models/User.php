<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * @return HasMany<Voto>
     */
    public function votos(): HasMany
    {
        return $this->hasMany(Voto::class);
    }

    public function votei(int $pergunta_id): bool
    {
        return $this->votos()
            ->where('pergunta_id', $pergunta_id)
            ->where('voto', 1)
            ->exists();
    }

    public function votar(Pergunta $pergunta): void
    {
        Voto::votar($this->id, $pergunta->id);
    }

    /**
     * @return HasMany<Pergunta>
     */
    public function perguntas(): HasMany
    {
        return $this->hasMany(Pergunta::class);
    }
}
