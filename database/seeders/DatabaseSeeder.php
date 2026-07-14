<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            // 1️⃣ Create all permissions
            $permissions = [
                ['name' => 'user_view', 'guard_name' => 'web', 'group_name' => 'User'],
                ['name' => 'user_create', 'guard_name' => 'web', 'group_name' => 'User'],
                ['name' => 'user_edit', 'guard_name' => 'web', 'group_name' => 'User'],
                ['name' => 'user_trash', 'guard_name' => 'web', 'group_name' => 'User'],
                ['name' => 'user_trash_view', 'guard_name' => 'web', 'group_name' => 'User'],
                ['name' => 'user_restore', 'guard_name' => 'web', 'group_name' => 'User'],

                ['name' => 'role_view', 'guard_name' => 'web', 'group_name' => 'Role'],
                ['name' => 'role_create', 'guard_name' => 'web', 'group_name' => 'Role'],
                ['name' => 'role_edit', 'guard_name' => 'web', 'group_name' => 'Role'],
                ['name' => 'role_trash', 'guard_name' => 'web', 'group_name' => 'Role'],
                ['name' => 'role_trash_view', 'guard_name' => 'web', 'group_name' => 'Role'],
                ['name' => 'role_restore', 'guard_name' => 'web', 'group_name' => 'Role'],

                ['name' => 'user_activity_view', 'guard_name' => 'web', 'group_name' => 'User Activity'],
            ];

            foreach ($permissions as $perm) {
                Permission::firstOrCreate(
                    ['name' => $perm['name'], 'guard_name' => $perm['guard_name']],
                    $perm
                );
            }

            // 2️⃣ Create Admin Role
            $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);

            // 3️⃣ Assign all permissions to Admin role
            $adminRole->syncPermissions(Permission::all());

            // 4️⃣ Create Admin User
            $adminUser = User::firstOrCreate(
                ['email' => 'admin@gmail.com'],
                [
                    'name' => 'Admin User',
                    'password' => Hash::make('123'),
                    'status' => 'active',
                ]
            );

            // 5️⃣ Assign Admin Role to Admin User
            $adminUser->assignRole($adminRole);

            DB::commit();

            $this->command->info('✅ Admin user, role, and permissions created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('❌ Failed to create Admin: ' . $e->getMessage());
        }
    }
}
