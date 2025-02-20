<?php

namespace Database\Seeders;

use App\Models\County;
use Illuminate\Database\Seeder;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        County::factory()
            ->count(5)
            ->create();
    }
}
