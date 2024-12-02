<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VulnerableTestSeeder extends Seeder
{
    public function run()
    {
        // Clear existing users first (except admin if exists)
        DB::table('users')->whereNotIn('email', ['admin@example.com'])->delete();

        // Create test users with sensitive data
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'credit_card_number' => '4532-1111-2222-3333',
                'phone_number' => '+62812-9999-8888',
                'national_id' => '3271082304990001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password456'),
                'credit_card_number' => '4539-4444-5555-6666',
                'phone_number' => '+62813-7777-6666',
                'national_id' => '3271082304990002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Robert Johnson',
                'email' => 'robert@example.com',
                'password' => Hash::make('password789'),
                'credit_card_number' => '4929-7777-8888-9999',
                'phone_number' => '+62814-5555-4444',
                'national_id' => '3271082304990003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maria Garcia',
                'email' => 'maria@example.com',
                'password' => Hash::make('passwordabc'),
                'credit_card_number' => '4716-2222-3333-4444',
                'phone_number' => '+62815-3333-2222',
                'national_id' => '3271082304990004',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david@example.com',
                'password' => Hash::make('passwordxyz'),
                'credit_card_number' => '4532-5555-6666-7777',
                'phone_number' => '+62816-1111-0000',
                'national_id' => '3271082304990005',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }

        // Add some orders with sensitive shipping information
        $users = DB::table('users')->pluck('id');
        
        foreach ($users as $userId) {
            DB::table('orders')->insert([
                'user_id' => $userId,
                'order_number' => 'ORD-' . str_pad($userId, 8, '0', STR_PAD_LEFT),
                'status' => 'pending',
                'total_amount' => rand(100000, 5000000),
                'shipping_address' => 'Jl. Rahasia No. ' . rand(1, 100) . ', Jakarta',
                'shipping_city' => 'Jakarta',
                'shipping_postal_code' => rand(10000, 99999),
                'shipping_phone' => '+628' . rand(100000000, 999999999),
                'notes' => 'Test order for SQL injection demo',
                'payment_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
