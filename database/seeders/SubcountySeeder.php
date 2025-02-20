<?php

namespace Database\Seeders;

use App\Models\Subcounty;
use Illuminate\Database\Seeder;

class SubcountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subcounty::factory()
            ->count(5)
            ->create();
    }
}
