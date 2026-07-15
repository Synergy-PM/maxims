<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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


            ['name' => 'client_view', 'guard_name' => 'web', 'group_name' => 'Client'],
            ['name' => 'client_create', 'guard_name' => 'web', 'group_name' => 'Client'],
            ['name' => 'client_edit', 'guard_name' => 'web', 'group_name' => 'Client'],
            ['name' => 'client_trash', 'guard_name' => 'web', 'group_name' => 'Client'],
            ['name' => 'client_trash_view', 'guard_name' => 'web', 'group_name' => 'Client'],
            ['name' => 'client_restore', 'guard_name' => 'web', 'group_name' => 'Client'],

            ['name' => 'booking_view', 'guard_name' => 'web', 'group_name' => 'Booking'],
            ['name' => 'booking_create', 'guard_name' => 'web', 'group_name' => 'Booking'],
            ['name' => 'booking_show', 'guard_name' => 'web', 'group_name' => 'Booking'],
            ['name' => 'booking_edit', 'guard_name' => 'web', 'group_name' => 'Booking'],
            ['name' => 'booking_trash', 'guard_name' => 'web', 'group_name' => 'Booking'],
            ['name' => 'booking_trash_view', 'guard_name' => 'web', 'group_name' => 'Booking'],
            ['name' => 'booking_restore', 'guard_name' => 'web', 'group_name' => 'Booking'],

            ['name' => 'expense_view', 'guard_name' => 'web', 'group_name' => 'Expense'],
            ['name' => 'expense_create', 'guard_name' => 'web', 'group_name' => 'Expense'],
            ['name' => 'expense_edit', 'guard_name' => 'web', 'group_name' => 'Expense'],
            ['name' => 'expense_trash', 'guard_name' => 'web', 'group_name' => 'Expense'],
            ['name' => 'expense_trash_view', 'guard_name' => 'web', 'group_name' => 'Expense'],
            ['name' => 'expense_restore', 'guard_name' => 'web', 'group_name' => 'Expense'],

            ['name' => 'expense_transaction_view', 'guard_name' => 'web', 'group_name' => 'Expense Transaction'],
            ['name' => 'expense_transaction_create', 'guard_name' => 'web', 'group_name' => 'Expense Transaction'],
            ['name' => 'expense_transaction_edit', 'guard_name' => 'web', 'group_name' => 'Expense Transaction'],
            ['name' => 'expense_transaction_trash', 'guard_name' => 'web', 'group_name' => 'Expense Transaction'],
            ['name' => 'expense_transaction_trash_view', 'guard_name' => 'web', 'group_name' => 'Expense Transaction'],
            ['name' => 'expense_transaction_restore', 'guard_name' => 'web', 'group_name' => 'Expense Transaction'],

            ['name' => 'client_Transactions_view', 'guard_name' => 'web', 'group_name' => 'Client Transactions'],
            ['name' => 'client_Transactions_create', 'guard_name' => 'web', 'group_name' => 'Client Transactions'],
            ['name' => 'client_Transactions_show', 'guard_name' => 'web', 'group_name' => 'Client Transactions'],
            ['name' => 'client_Transactions_edit', 'guard_name' => 'web', 'group_name' => 'Client Transactions'],
            ['name' => 'client_Transactions_trash', 'guard_name' => 'web', 'group_name' => 'Client Transactions'],
            ['name' => 'client_Transactions_trash_view', 'guard_name' => 'web', 'group_name' => 'Client Transactions'],
            ['name' => 'client_Transactions_restore', 'guard_name' => 'web', 'group_name' => 'Client Transactions'],

            ['name' => 'company_view', 'guard_name' => 'web', 'group_name' => 'Company'],
            ['name' => 'company_create', 'guard_name' => 'web', 'group_name' => 'Company'],
            ['name' => 'company_edit', 'guard_name' => 'web', 'group_name' => 'Company'],
            ['name' => 'company_trash', 'guard_name' => 'web', 'group_name' => 'Company'],
            ['name' => 'company_trash_view', 'guard_name' => 'web', 'group_name' => 'Company'],
            ['name' => 'company_restore', 'guard_name' => 'web', 'group_name' => 'Company'],

            ['name' => 'Ledger_Filter_view', 'guard_name' => 'web', 'group_name' => 'Ledger Filter'],

        ]);
    }
}
