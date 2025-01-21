<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destination>
 */
class DestinationFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->company(); // Using company instead of name for more destination-like names

        return [
            //
            'name' => $name,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'description' => $this->faker->text,
            'slug' => Str::slug($name),
            'address' => $this->faker->address,
            'open_at' => $this->faker->time(),
            'close_at' => $this->faker->time(),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
        ];
    }
}
