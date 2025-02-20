<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::firstOrCreate(['name' => 'list bookings']);
        Permission::firstOrCreate(['name' => 'view bookings']);
        Permission::firstOrCreate(['name' => 'create bookings']);
        Permission::firstOrCreate(['name' => 'update bookings']);
        Permission::firstOrCreate(['name' => 'delete bookings']);

        Permission::firstOrCreate(['name' => 'list counties']);
        Permission::firstOrCreate(['name' => 'view counties']);
        Permission::firstOrCreate(['name' => 'create counties']);
        Permission::firstOrCreate(['name' => 'update counties']);
        Permission::firstOrCreate(['name' => 'delete counties']);

        Permission::firstOrCreate(['name' => 'list flatsbails']);
        Permission::firstOrCreate(['name' => 'view flatsbails']);
        Permission::firstOrCreate(['name' => 'create flatsbails']);
        Permission::firstOrCreate(['name' => 'update flatsbails']);
        Permission::firstOrCreate(['name' => 'delete flatsbails']);

        Permission::firstOrCreate(['name' => 'list offenders']);
        Permission::firstOrCreate(['name' => 'view offenders']);
        Permission::firstOrCreate(['name' => 'create offenders']);
        Permission::firstOrCreate(['name' => 'update offenders']);
        Permission::firstOrCreate(['name' => 'delete offenders']);

     Permission::firstOrCreate(['name' => 'list witness']);
        Permission::firstOrCreate(['name' => 'view witness']);
        Permission::firstOrCreate(['name' => 'create witness']);
        Permission::firstOrCreate(['name' => 'update witness']);
        Permission::firstOrCreate(['name' => 'delete witness']);
    Permission::firstOrCreate(['name' => 'list offended']);

        Permission::firstOrCreate(['name' => 'view offended']);
        Permission::firstOrCreate(['name' => 'create offended']);
        Permission::firstOrCreate(['name' => 'update offended']);
        Permission::firstOrCreate(['name' => 'delete offended']);

        Permission::firstOrCreate(['name' => 'list offenses']);
        Permission::firstOrCreate(['name' => 'view offenses']);
        Permission::firstOrCreate(['name' => 'create offenses']);
        Permission::firstOrCreate(['name' => 'update offenses']);
        Permission::firstOrCreate(['name' => 'delete offenses']);

        Permission::firstOrCreate(['name' => 'list offensecases']);
        Permission::firstOrCreate(['name' => 'view offensecases']);
        Permission::firstOrCreate(['name' => 'create offensecases']);
        Permission::firstOrCreate(['name' => 'update offensecases']);
        Permission::firstOrCreate(['name' => 'delete offensecases']);

        Permission::firstOrCreate(['name' => 'list officers']);
        Permission::firstOrCreate(['name' => 'view officers']);
        Permission::firstOrCreate(['name' => 'create officers']);
        Permission::firstOrCreate(['name' => 'update officers']);
        Permission::firstOrCreate(['name' => 'delete officers']);

        Permission::firstOrCreate(['name' => 'list signatures']);
        Permission::firstOrCreate(['name' => 'view signatures']);
        Permission::firstOrCreate(['name' => 'create signatures']);
        Permission::firstOrCreate(['name' => 'update signatures']);
        Permission::firstOrCreate(['name' => 'delete signatures']);

        Permission::firstOrCreate(['name' => 'list statements']);
        Permission::firstOrCreate(['name' => 'view statements']);
        Permission::firstOrCreate(['name' => 'create statements']);
        Permission::firstOrCreate(['name' => 'update statements']);
        Permission::firstOrCreate(['name' => 'delete statements']);

        Permission::firstOrCreate(['name' => 'list allstatementfiles']);
        Permission::firstOrCreate(['name' => 'view allstatementfiles']);
        Permission::firstOrCreate(['name' => 'create allstatementfiles']);
        Permission::firstOrCreate(['name' => 'update allstatementfiles']);
        Permission::firstOrCreate(['name' => 'delete allstatementfiles']);

        Permission::firstOrCreate(['name' => 'list stations']);
        Permission::firstOrCreate(['name' => 'view stations']);
        Permission::firstOrCreate(['name' => 'create stations']);
        Permission::firstOrCreate(['name' => 'update stations']);
        Permission::firstOrCreate(['name' => 'delete stations']);

        Permission::firstOrCreate(['name' => 'list subcounties']);
        Permission::firstOrCreate(['name' => 'view subcounties']);
        Permission::firstOrCreate(['name' => 'create subcounties']);
        Permission::firstOrCreate(['name' => 'update subcounties']);
        Permission::firstOrCreate(['name' => 'delete subcounties']);

        Permission::firstOrCreate(['name' => 'list wards']);
        Permission::firstOrCreate(['name' => 'view wards']);
        Permission::firstOrCreate(['name' => 'create wards']);
        Permission::firstOrCreate(['name' => 'update wards']);
        Permission::firstOrCreate(['name' => 'delete wards']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::firstOrCreate(['name' => 'officer']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::firstOrCreate(['name' => 'list roles']);
        Permission::firstOrCreate(['name' => 'view roles']);
        Permission::firstOrCreate(['name' => 'create roles']);
        Permission::firstOrCreate(['name' => 'update roles']);
        Permission::firstOrCreate(['name' => 'delete roles']);
        Permission::firstOrCreate(['name' => 'view activity']);

        Permission::firstOrCreate(['name' => 'list permissions']);
        Permission::firstOrCreate(['name' => 'view permissions']);
        Permission::firstOrCreate(['name' => 'create permissions']);
        Permission::firstOrCreate(['name' => 'update permissions']);
        Permission::firstOrCreate(['name' => 'delete permissions']);

        Permission::firstOrCreate(['name' => 'list users']);
        Permission::firstOrCreate(['name' => 'view users']);
        Permission::firstOrCreate(['name' => 'create users']);
        Permission::firstOrCreate(['name' => 'update users']);
        Permission::firstOrCreate(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
