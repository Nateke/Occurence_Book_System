<?php

namespace Database\Seeders;

use App\Models\Signature;
use Illuminate\Database\Seeder;

class SignatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Signature::factory()
            ->count(5)
            ->create();
    }
}
