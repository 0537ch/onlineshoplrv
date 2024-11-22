<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        // Misalkan ini adalah user yang sudah terdaftar
        $adminUser = User::find(1); // Ganti dengan ID user yang sesuai
        $adminUser->assignRole('admin');

        $productManagerUser = User::find(2); // Ganti dengan ID user yang sesuai
        $productManagerUser->assignRole('product_manager');

        $salesStaffUser = User::find(3); // Ganti dengan ID user yang sesuai
        $salesStaffUser->assignRole('sales_staff');
    }
}

