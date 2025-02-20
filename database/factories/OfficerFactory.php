<?php

namespace Database\Factories;

use App\Models\Officer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfficerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Officer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'officer_name' => $this->faker->text(255),
            'badge_number' => $this->faker->text(255),
            'rank' => $this->faker->text(255),
            'station_id' => \App\Models\Station::factory(),
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
        ];
    }
}
