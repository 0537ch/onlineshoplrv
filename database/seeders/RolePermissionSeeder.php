<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Membuat permission
        Permission::create(['name' => 'manage products']);
        Permission::create(['name' => 'manage categories']);
        Permission::create(['name' => 'manage orders']);
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'manage users']);

        // Membuat role Admin dan memberikan semua permission
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        // Membuat role Product Manager dan memberikan permission terkait produk dan kategori
        $productManager = Role::create(['name' => 'product_manager']);
        $productManager->givePermissionTo(['manage products', 'manage categories']);

        // Membuat role Sales Staff dan memberikan permission terkait pesanan
        $salesStaff = Role::create(['name' => 'sales_staff']);
        $salesStaff->givePermissionTo(['view orders', 'manage orders']);

        // Membuat role Customer tanpa permission
        Role::create(['name' => 'customer']);
    }
}
