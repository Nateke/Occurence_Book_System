<?php

namespace Database\Seeders;

use App\Models\Offender;
use Illuminate\Database\Seeder;

class OffenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offender::factory()
            ->count(5)
            ->create();
    }
}
