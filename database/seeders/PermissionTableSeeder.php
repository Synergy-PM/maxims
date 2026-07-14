<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
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
            
        ]);
    }
}
