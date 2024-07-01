<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voto>
 */
class VotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $userId = 1;

        return [
            'user_id'     => $userId++,
            'pergunta_id' => $this->faker->numberBetween(1, 10),
            'voto'        => $this->faker->numberBetween(0, 1),
        ];
    }
}
