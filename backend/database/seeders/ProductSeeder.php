<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Product 1',
                'category' => 'Electronics',
                'description' => 'This is a description for product 1. It is a great electronic device that serves many purposes.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 2',
                'category' => 'Furniture',
                'description' => 'This is a description for product 2. It is a beautifully designed piece of furniture for your home.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 3',
                'category' => 'Clothing',
                'description' => 'This is a description for product 3. A comfortable and stylish piece of clothing for all seasons.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 4',
                'category' => 'Sports',
                'description' => 'This is a description for product 4. A high-quality sports equipment for outdoor activities.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 5',
                'category' => 'Books',
                'description' => 'This is a description for product 5. A fascinating book on personal growth and development.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 6',
                'category' => 'Toys',
                'description' => 'This is a description for product 6. A fun and educational toy for children of all ages.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 7',
                'category' => 'Home Appliances',
                'description' => 'This is a description for product 7. A state-of-the-art home appliance to make your life easier.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 8',
                'category' => 'Groceries',
                'description' => 'This is a description for product 8. A fresh and healthy selection of groceries for your kitchen.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 9',
                'category' => 'Automotive',
                'description' => 'This is a description for product 9. A reliable automotive part for your car’s maintenance.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 10',
                'category' => 'Beauty',
                'description' => 'This is a description for product 10. A luxurious beauty product that enhances your skin.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
