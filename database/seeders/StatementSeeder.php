<?php

namespace Database\Seeders;

use App\Models\Statement;
use Illuminate\Database\Seeder;

class StatementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Statement::factory()
            ->count(5)
            ->create();
    }
}
