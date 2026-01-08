<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        $permissions = [
            'products-view',
            'products-create',
            'products-update',
            'products-delete'
        ];

        $roles = [
            'admin',
            'staff',
            'viewer'
        ];

        foreach($permissions as $permission) {
            Permission::create(
                [ 'name' => $permission ]
            );
        }

        foreach($roles as $role) {
            Role::create(
                [ 'name' => $role ]
            );
        }

        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->givePermissionTo(Permission::all());

        $staffRole = Role::where('name', 'staff')->first();
        $staffRole->givePermissionTo(
            [ 'products-view', 'products-create', 'products-update' ]
        );

        $viewerRole = Role::where('name', 'viewer')->first();
        $viewerRole->givePermissionTo(
            [ 'products-view' ]
        );

        $admin = User::factory()->state(
            [ 'name' => 'Admin',
              'email' => 'admin@mail.com'
            ]
        )->hasProducts(5)
         ->create();

         $admin->assignRole('admin');

        $staff = User::factory()->state(
            [ 'name' => 'Staff',
              'email' => 'staff@mail.com'
            ]
        )->hasProducts(5)
         ->create();

         $staff->assignRole('staff');

        $viewer = User::factory()->state(
            [ 'name' => 'Viewer',
              'email' => 'viewer@mail.com'
            ]
        )->hasProducts(5)
         ->create();

        $viewer->assignRole('viewer');
    }
}
