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
        $images = [
            'https://t3.ftcdn.net/jpg/05/59/27/48/360_F_559274893_O9iSRQwTKIkAooNTglilMgx2yMcXK9Or.jpg',
            'https://cdn.mos.cms.futurecdn.net/ASHH5bDmsp6wnK6mEfZdcU-650-80.jpg.webp'
            // Dodaj tutaj więcej adresów URL swoich zdjęć
        ];

        return [
            'name' => $this->faker->name(),
            'race' => $this->faker->randomElement(['Alaskan Malamute', 'Shih Tzu', 'Dalmatyńczyk', 'Chow Chow', 'Australijski Owczarek', 'Seter Irlandzki', 'Beagle', 'Samoyed', 'Sznaucer miniaturowy', 'Pomeranian', 'Border Collie', 'Bull Terrier', 'Basset Hound', 'Cocker Spaniel', 'Dogo Argentino']),
            'gender' => $this->faker->randomElement(['MALE','FEMALE']),
            'age' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->randomElement(['OPIS','OPIS 1','OPIS 2']),
            'image' => $this->faker->randomElement($images), // Wybierz losowy adres URL zdjęcia
        ];
    }

}
