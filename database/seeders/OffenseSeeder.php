<?php

namespace Database\Seeders;

use App\Models\Offense;
use Illuminate\Database\Seeder;

class OffenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offense::factory()
            ->count(5)
            ->create();
    }
}
