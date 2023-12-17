<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::inRandomOrder()->first();
        $faker = Faker::create();

        $data = [
            [
                'user_id' =>  $user->user_id,
                'order_code' => 'ORD-' . $faker->unique()->randomNumber(5),
                'order_date' => now(),
                'total_price' => $faker->randomFloat(2, 10, 10000),
                'order_note' => $faker->paragraph(),
                'order_status' => 'PENDING'
            ],
            [
                'user_id' =>  $user->user_id,
                'order_code' => 'ORD-' . $faker->unique()->randomNumber(5),
                'order_date' => now(),
                'total_price' => $faker->randomFloat(2, 10, 10000),
                'order_note' => $faker->paragraph(),
                'order_status' => 'PROCESSED'
            ],
            [
                'user_id' =>  $user->user_id,
                'order_code' => 'ORD-' . $faker->unique()->randomNumber(5),
                'order_date' => now(),
                'total_price' => $faker->randomFloat(2, 10, 10000),
                'order_note' => $faker->paragraph(),
                'order_status' => 'FINISHED'
            ],
            [
                'user_id' =>  $user->user_id,
                'order_code' => 'ORD-' . $faker->unique()->randomNumber(5),
                'order_date' => now(),
                'total_price' => $faker->randomFloat(2, 10, 10000),
                'order_note' => $faker->paragraph(),
                'order_status' => 'CANCELED'
            ],
        ];
        Order::insert($data);
    }
}
