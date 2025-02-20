<?php

namespace Database\Factories;

use App\Models\Statement;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Statement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'statement_text' => $this->faker->text(),
            'recording_date' => $this->faker->dateTime('now', 'UTC'),
            'files_id' => $this->faker->randomNumber(),
            'booking_id' => $this->faker->randomNumber(),
            'recorded_by' => \App\Models\Officer::factory(),
        ];
    }
}
