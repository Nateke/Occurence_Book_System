<?php

namespace Database\Seeders;

use App\Models\OffenseCase;
use Illuminate\Database\Seeder;

class OffenseCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OffenseCase::factory()
            ->count(5)
            ->create();
    }
}
