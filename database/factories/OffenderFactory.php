<?php

namespace Database\Factories;

use App\Models\Offender;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OffenderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offender::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => $this->faker->randomNumber(),
            'id_scan' => $this->faker->randomNumber(),
            'underage_flag' => $this->faker->boolean(),
            'phone_number' => $this->faker->phoneNumber(),
            'country_id' => $this->faker->randomNumber(),
            'location' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'occupation' => $this->faker->text(255),
            'county_id' => \App\Models\County::factory(),
            'subcounty_id' => \App\Models\Subcounty::factory(),
            'ward_id' => \App\Models\Ward::factory(),
        ];
    }
}
