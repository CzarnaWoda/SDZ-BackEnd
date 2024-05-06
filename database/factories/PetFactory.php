<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Invoice;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'race' => $this->faker->randomElement(['L','M','B']),
            'gender' => $this->faker->randomElement(['MALE','FEMALE']),
            'age' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->randomElement(['OPIS','OPIS 1','OPIS 2']),
            'image' => $this->faker->image(),
            'invoice_id' => Invoice::factory(),

        ];
    }
}
