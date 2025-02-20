<?php

namespace Database\Factories;

use App\Models\Station;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Station::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'station_name' => $this->faker->name(),
            'station_number' =>$this->faker->randomNumber(),
            'location' => $this->faker->name(),
            'subcounty_id' => \App\Models\Subcounty::factory(),
            'ward_id' => \App\Models\Ward::factory(),
            'county_id' => \App\Models\County::factory(),
        ];
    }
}
