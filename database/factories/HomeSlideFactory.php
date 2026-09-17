<?php

namespace Database\Factories;

use App\Models\HomeSlide;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HomeSlide>
 */
class HomeSlideFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => 'images/carousel/01.jpg',
            'kicker' => 'Trust, Growth, Community',
            'heading' => fake()->sentence(6),
            'text' => fake()->sentence(16),
            'cta_label' => 'Apply for Loan',
            'cta_url' => '/apply-loan',
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
