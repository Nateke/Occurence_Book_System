<?php

namespace Database\Factories;

use App\Models\OffenseCase;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OffenseCaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OffenseCase::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => $this->faker->randomNumber(),
            'offence_id' => $this->faker->randomNumber(),
            'id_no' => $this->faker->randomNumber(),
            'court_date' => $this->faker->date(),
            'legal_adviser_comments' => $this->faker->text(),
        ];
    }
}
