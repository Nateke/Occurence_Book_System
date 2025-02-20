<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\StatementFiles;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatementFilesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StatementFiles::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_url' => $this->faker->text(255),
            'statement_id' => \App\Models\Statement::factory(),
        ];
    }
}
