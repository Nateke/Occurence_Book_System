<?php

namespace Database\Seeders;

use App\Models\StatementFiles;
use Illuminate\Database\Seeder;

class StatementFilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatementFiles::factory()
            ->count(5)
            ->create();
    }
}
