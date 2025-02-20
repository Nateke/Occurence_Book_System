<?php

namespace Database\Seeders;

use App\Models\FlatsBail;
use Illuminate\Database\Seeder;

class FlatsBailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FlatsBail::factory()
            ->count(5)
            ->create();
    }
}
