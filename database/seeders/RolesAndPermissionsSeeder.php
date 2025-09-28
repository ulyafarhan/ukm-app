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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view_any_user', 'view_user', 'create_user', 'update_user', 'delete_user',
            'view_any_member', 'view_member', 'create_member', 'update_member', 'delete_member',
            'view_any_transaction', 'view_transaction', 'create_transaction', 'update_transaction', 'delete_transaction',
            'view_any_event', 'view_event', 'create_event', 'update_event', 'delete_event',
            'view_any_document', 'view_document', 'create_document', 'update_document', 'delete_document', 'generate_surat',
            'view_any_product', 'view_product', 'create_product', 'update_product', 'delete_product',
            'view_any_sale', 'view_sale', 'create_sale', 'update_sale', 'delete_sale',
            'view_any_post', 'view_post', 'create_post', 'update_post', 'delete_post',
            'view_any_registration', 'view_registration', 'create_registration', 'update_registration', 'delete_registration',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        $pengurusRole = Role::create(['name' => 'Pengurus']);
        $pengurusPermissions = [
            'view_any_member', 'view_member', 'create_member', 'update_member',
            'view_any_transaction', 'view_transaction', 'create_transaction', 'update_transaction',
            'view_any_event', 'view_event', 'create_event', 'update_event',
            'view_any_document', 'view_document', 'create_document', 'update_document', 'generate_surat',
            'view_any_product', 'view_product', 'create_product', 'update_product',
            'view_any_sale', 'view_sale', 'create_sale', 'update_sale',
            'view_any_post', 'view_post', 'create_post', 'update_post',
            'view_any_registration', 'view_registration', 'update_registration',
        ];
        $pengurusRole->givePermissionTo($pengurusPermissions);

        // Assign roles to users
        $superAdminUser = User::find(1);
        if ($superAdminUser) {
            $superAdminUser->assignRole('Super Admin');
        }

        $pengurusUser = User::find(2);
        if ($pengurusUser) {
            $pengurusUser->assignRole('Pengurus');
        }
    }
}