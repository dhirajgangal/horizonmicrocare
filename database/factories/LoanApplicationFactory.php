<?php

namespace Database\Factories;

use App\Enums\ApplicationStatus;
use App\Models\LoanApplication;
use App\Models\LoanProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LoanApplication>
 */
class LoanApplicationFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'loan_product_id' => LoanProduct::factory(),
            'requested_amount' => fake()->numberBetween(15000, 150000),
            'purpose' => fake()->sentence(8),
            'full_name' => fake()->name('female'),
            'mobile' => fake()->numerify('98########'),
            'email' => fake()->unique()->safeEmail(),
            'gender' => 'Woman',
            'date_of_birth' => fake()->dateTimeBetween('-50 years', '-21 years')->format('Y-m-d'),
            'state' => 'Maharashtra',
            'district' => fake()->city(),
            'pincode' => fake()->numerify('######'),
            'address' => fake()->streetAddress(),
            'occupation' => fake()->jobTitle(),
            'monthly_income' => '10000-25000',
            'marital_status' => 'Married',
            'consent' => true,
            'status' => ApplicationStatus::New,
            'internal_notes' => null,
        ];
    }
}
