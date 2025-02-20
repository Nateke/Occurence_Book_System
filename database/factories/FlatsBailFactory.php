<?php

namespace Database\Factories;

use App\Models\FlatsBail;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlatsBailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FlatsBail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomNumber(2),
            'conditions' => $this->faker->text(255),
            'release_date' => $this->faker->dateTime('now', 'UTC'),
            'surety_details' => $this->faker->text(255),
        ];
    }
}
