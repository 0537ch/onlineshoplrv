<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Apple',
            'Samsung',
            'Sony',
            'Asus',
            'Dell',
            'Logitech',
            'JBL'
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand,
                'slug' => Str::slug($brand),
                'is_active' => true
            ]);
        }
    }
}
