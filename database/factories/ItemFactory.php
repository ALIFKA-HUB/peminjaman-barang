<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->randomElement(['Laptop Asus', 'Kamera Canon', 'Proyektor BenQ']),
            'kategori' => $this->faker->randomElement(['Laptop', 'Kamera', 'Proyektor']),
            'total_stok' => 10,
        ];
    }
}
