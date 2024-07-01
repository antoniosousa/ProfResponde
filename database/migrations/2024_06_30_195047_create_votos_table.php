<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('votos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pergunta_id')->constrained()->onDelete('cascade');
            $table->smallInteger('voto'); // 1 ou 0 voto
            $table->timestamps();

            // indice para evitar duplicidades em votos de usuários para uma mesma pergunta
            $table->unique(['user_id', 'pergunta_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votos');
    }
};
