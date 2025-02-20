<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_date' => $this->faker->date(),
            'booking_time' => $this->faker->dateTimeThisMonth(),
            'location' => $this->faker->text(255),
            'remarks' => $this->faker->text(255),
            'evidence_collected' => $this->faker->text(255),
            'officer_id' => \App\Models\Officer::factory(),
//            'offenseCase_id' => \App\Models\Signature::factory(),
//            'offenseCase_id' => \App\Models\Statement::factory(),
//            'offenseCase_id' => \App\Models\FlatsBail::factory(),
//            'offenseCase_id' => \App\Models\Offender::factory(),
            'offenseCase_id' => \App\Models\OffenseCase::factory(),
        ];
    }
}
