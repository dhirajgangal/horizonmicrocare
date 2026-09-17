<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Faq>
 */
class FaqFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => fake()->sentence().'?',
            'answer' => fake()->paragraph(),
            'category' => fake()->randomElement(['General', 'Application', 'Support']),
            'is_active' => true,
            'is_featured' => fake()->boolean(40),
            'sort_order' => fake()->numberBetween(1, 20),
        ];
    }
}
