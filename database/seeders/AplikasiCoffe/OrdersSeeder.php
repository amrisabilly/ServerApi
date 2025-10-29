<?php

namespace Database\Seeders\AplikasiCoffe;

use Illuminate\Database\Seeder;
use App\Models\AplikasiCoffe\Orders;
use App\Models\AplikasiCoffe\Order_items;
use App\Models\AplikasiCoffe\User;
use App\Models\AplikasiCoffe\Product;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::pluck('id')->toArray();
        $products = Product::all();

        // Buat 10 order
        for ($i = 1; $i <= 10; $i++) {
            $user_id = $users[array_rand($users)];
            $order = Orders::create([
                'user_id' => $user_id,
                'total' => 0, // akan diupdate setelah items dibuat
                'status' => 'pending',
            ]);

            $total = 0;
            // Setiap order punya 2-4 item
            $itemsCount = rand(2, 4);
            $pickedProducts = $products->random($itemsCount);

            foreach ($pickedProducts as $product) {
                $qty = rand(1, 3);
                $price = $product->price ?? rand(50000, 150000);
                $total += $qty * $price;

                Order_items::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'qty' => $qty,
                    'price' => $price,
                ]);
            }

            $order->update(['total' => $total]);
        }
    }
}
