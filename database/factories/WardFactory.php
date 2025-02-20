<?php

namespace Database\Factories;

use App\Models\Ward;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ward::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'subcounty_id' => \App\Models\Subcounty::factory(),
        ];
    }
}
