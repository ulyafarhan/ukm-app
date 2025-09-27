<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Roles
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $bendaharaRole = Role::create(['name' => 'Bendahara']);
        $sekretarisRole = Role::create(['name' => 'Sekretaris']);

        // Berikan semua hak akses ke Super Admin (secara implisit)

        // Cari user pertama (biasanya admin utama)
        $user = User::find(1);
        if ($user) {
            $user->assignRole($superAdminRole);
        }
    }
}