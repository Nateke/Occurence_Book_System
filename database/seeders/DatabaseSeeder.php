<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('password'),
            ]);
        $this->call(PermissionsSeeder::class);

//        $this->call(BookingSeeder::class);
        $this->call(CountySeeder::class);
//        $this->call(FlatsBailSeeder::class);
//        $this->call(OffenderSeeder::class);
        $this->call(OffenseSeeder::class);
//        $this->call(OffenseCaseSeeder::class);
        $this->call(OfficerSeeder::class);
//        $this->call(SignatureSeeder::class);
//        $this->call(StatementSeeder::class);
//        $this->call(StatementFilesSeeder::class);
        $this->call(StationSeeder::class);
        $this->call(SubcountySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WardSeeder::class);
    }
}
