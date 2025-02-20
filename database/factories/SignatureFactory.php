<?php

namespace Database\Factories;

use App\Models\Signature;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SignatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Signature::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => $this->faker->randomNumber(),
            'witness_signature' => $this->faker->text(),
            'offended_signature' => $this->faker->text(),
            'offender_signature' => $this->faker->text(),
            'signature_date' => $this->faker->dateTime('now', 'UTC'),
        ];
    }
}
