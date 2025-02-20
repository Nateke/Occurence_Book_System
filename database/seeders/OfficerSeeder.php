<?php

namespace Database\Seeders;

use App\Models\Officer;
use Illuminate\Database\Seeder;

class OfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Officer::factory()
            ->count(5)
            ->create();
    }
}
