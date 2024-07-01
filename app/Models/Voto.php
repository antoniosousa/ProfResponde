<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voto extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function pergunta(): BelongsTo
    {
        return $this->belongsTo(Pergunta::class);
    }

    public static function votar(int $userId, int $perguntaId): void
    {
        $voto = self::where('user_id', $userId)
            ->where('pergunta_id', $perguntaId)
            ->first();

        if($voto) {
            $voto->update(['voto' => $voto->voto ? 0 : 1]);
        } else {
            self::create([
                'user_id'     => $userId,
                'pergunta_id' => $perguntaId,
                'voto'        => 1,
            ]);
        }
    }
}
