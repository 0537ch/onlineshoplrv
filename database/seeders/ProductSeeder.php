<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Smartphones
            ['iPhone 14 Pro Max', 'Apple', 'Smartphone', 18999000],
            ['iPhone 14 Pro', 'Apple', 'Smartphone', 16999000],
            ['iPhone 14', 'Apple', 'Smartphone', 14999000],
            ['iPhone 13', 'Apple', 'Smartphone', 12999000],
            ['Samsung Galaxy S23 Ultra', 'Samsung', 'Smartphone', 17999000],
            ['Samsung Galaxy S23+', 'Samsung', 'Smartphone', 15999000],
            ['Samsung Galaxy S23', 'Samsung', 'Smartphone', 13999000],
            ['Samsung Galaxy A54', 'Samsung', 'Smartphone', 6999000],

            // Laptops
            ['MacBook Pro 16"', 'Apple', 'Laptop', 39999000],
            ['MacBook Pro 14"', 'Apple', 'Laptop', 34999000],
            ['MacBook Air M2', 'Apple', 'Laptop', 19999000],
            ['MacBook Air M1', 'Apple', 'Laptop', 14999000],
            ['ASUS ROG Zephyrus', 'Asus', 'Laptop', 29999000],
            ['ASUS TUF Gaming', 'Asus', 'Laptop', 19999000],
            ['Dell XPS 15', 'Dell', 'Laptop', 27999000],
            ['Dell XPS 13', 'Dell', 'Laptop', 24999000],

            // Audio
            ['AirPods Pro 2', 'Apple', 'Audio', 3999000],
            ['AirPods 3', 'Apple', 'Audio', 2999000],
            ['Galaxy Buds2 Pro', 'Samsung', 'Audio', 2899000],
            ['Sony WH-1000XM5', 'Sony', 'Audio', 4999000],
            ['Sony WF-1000XM4', 'Sony', 'Audio', 3499000],
            ['JBL Quantum 800', 'JBL', 'Audio', 2999000],
            ['JBL Flip 6', 'JBL', 'Audio', 1999000],
            ['JBL Charge 5', 'JBL', 'Audio', 2499000],

            // Gaming
            ['PlayStation 5', 'Sony', 'Gaming', 9999000],
            ['DualSense Controller', 'Sony', 'Gaming', 899000],
            ['PS5 HD Camera', 'Sony', 'Gaming', 799000],
            ['ROG Swift PG32UQ', 'Asus', 'Gaming', 12999000],
            ['ROG Strix Scope', 'Asus', 'Gaming', 1999000],
            ['Logitech G Pro X', 'Logitech', 'Gaming', 1799000],
            ['Logitech G502', 'Logitech', 'Gaming', 999000],
            ['Logitech G733', 'Logitech', 'Gaming', 1999000],

            // Accessories
            ['Magic Keyboard', 'Apple', 'Accessories', 1999000],
            ['Magic Mouse', 'Apple', 'Accessories', 1499000],
            ['Samsung 45W Charger', 'Samsung', 'Accessories', 499000],
            ['Galaxy SmartTag+', 'Samsung', 'Accessories', 599000],
            ['ROG Slash Backpack', 'Asus', 'Accessories', 899000],
            ['Logitech MX Keys', 'Logitech', 'Accessories', 1599000],
            ['Logitech MX Master 3S', 'Logitech', 'Accessories', 1499000],
            ['Logitech Webcam C920', 'Logitech', 'Accessories', 999000],
        ];

        foreach ($products as [$name, $brandName, $categoryName, $price]) {
            $brand = Brand::where('name', $brandName)->first();
            $category = Category::where('name', $categoryName)->first();

            Product::create([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(6),
                'description' => fake()->paragraph(3),
                'price' => $price,
                'brand_id' => $brand->id,
                'category_id' => $category->id,
                'sku' => strtoupper(Str::random(10)),
                'in_stock' => rand(10, 100),
                'is_active' => true,
            ]);
        }
    }
}
