<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'First product',
                'description' => 'Lorem ipsum dolor sit amet',
                'price' => 234234.00,
                'image' => 'https://i0.wp.com/www.fb101.com/wp-content/uploads/2019/07/FoodProductTop.jpg?fit=678%2C298&ssl=1',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'name' => 'Second product',
                'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem',
                'price' => 134114.20,
                'image' => 'https://images.fastcompany.net/image/upload/w_1280,f_auto,q_auto,fl_lossy/wp-cms/uploads/2022/03/p-1-most-innovative-products-2022-90731853.jpg',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        ];

        foreach ($data as $datum) {
            Product::query()->create($datum);
        }
    }
}
