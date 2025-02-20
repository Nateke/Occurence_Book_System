<?php

namespace Database\Factories;

use App\Models\Subcounty;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcountyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subcounty::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subcounty_name' => $this->faker->text(255),
            'county_id' => \App\Models\County::factory(),
        ];
    }
}
