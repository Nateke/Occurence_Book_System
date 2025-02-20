<?php

namespace Database\Factories;

use App\Models\Offense;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OffenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offense::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'offence_name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
            'fine_amount' => $this->faker->randomNumber(2),
            'imprisonment_duration' => $this->faker->text(255),
        ];
    }
}
