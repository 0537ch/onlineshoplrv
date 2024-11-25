<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menjalankan RolePermissionSeeder terlebih dahulu
        $this->call([
            RolePermissionSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
        ]);

        // Membuat user dengan factory
        $adminUser = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.net',
            'password' => bcrypt('admin'), // Pastikan password aman
        ]);

        $productManagerUser = \App\Models\User::factory()->create([
            'name' => 'Product Manager',
            'email' => 'manager@example.com',
            'password' => bcrypt('password'),
        ]);

        $salesStaffUser = \App\Models\User::factory()->create([
            'name' => 'Sales Staff',
            'email' => 'sales@example.net',
            'password' => bcrypt('sales'),
        ]);

        // Assign roles untuk setiap user
        $adminUser->assignRole('admin');
        $productManagerUser->assignRole('product_manager');
        $salesStaffUser->assignRole('sales_staff');
    }
}
