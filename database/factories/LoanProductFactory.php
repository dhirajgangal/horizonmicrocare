<?php

namespace Database\Factories;

use App\Models\LoanProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<LoanProduct>
 */
class LoanProductFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true).' Livelihood Loan';

        return [
            'name' => Str::title($name),
            'slug' => Str::slug($name).'-'.fake()->unique()->numerify('###'),
            'short_description' => fake()->sentence(12),
            'description' => fake()->paragraphs(3, true),
            'features' => [
                'Designed to support women-led livelihoods',
                'Guidance through the enquiry and application process',
                'Community-based support after disbursement by the lending partner',
            ],
            'eligibility' => 'Applicants are typically women seeking support for a livelihood activity. Final eligibility is decided by the lending partner, not this website.',
            'required_documents' => "Identity proof\nAddress proof\nRecent photograph\nBasic income or activity details",
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 20),
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
