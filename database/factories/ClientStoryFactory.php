<?php

namespace Database\Factories;

use App\Models\ClientStory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ClientStory>
 */
class ClientStoryFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->firstName('female').' '.fake()->lastName();

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->numerify('###'),
            'photo' => 'images/clients/client-01.png',
            'feedback' => fake()->paragraph(),
            'location' => fake()->city().', Maharashtra',
            'is_published' => true,
            'sort_order' => fake()->numberBetween(1, 20),
        ];
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
        ]);
    }
}
