<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkCheck>
 */
class WorkCheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkDate = $this->faker->dateTimeBetween('-6 months', 'now');
        $expiryDate = $this->faker->dateTimeBetween($checkDate, '+1 year');

        return [
            'staff_id' => \App\Models\Staff::inRandomOrder()->first()?->id ?? 1,
            'check_date' => $checkDate,
            'document_id' => \App\Models\Document::inRandomOrder()->first()?->id ?? 1,
            'checked_by' => $this->faker->name(),
            'expiry_date' => $expiryDate,
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
