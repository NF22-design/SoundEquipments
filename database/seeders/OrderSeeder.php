<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(5)->create()->each(function (User $user) {
            Order::factory(2)->create([
                'user_id' => $user->id
            ])->each(function (Order $order) {
                $products = Product::inRandomOrder()->take(rand(1, 3))->get();
                $total = 0;
                foreach ($products as $product) {
                    $quantity = rand(1, 3);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price
                    ]);
                    $total += $product->price * $quantity;
                }
                $order->update([
                    'total_price' => $total
                ]);
            });
        });
    }
}