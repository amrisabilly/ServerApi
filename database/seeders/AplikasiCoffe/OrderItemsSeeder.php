<?php

namespace Database\Seeders\AplikasiCoffe;

use Illuminate\Database\Seeder;
use App\Models\AplikasiCoffe\Order_items;
use App\Models\AplikasiCoffe\Orders;
use App\Models\AplikasiCoffe\Product;

class OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Orders::all();
        $products = Product::all();

        foreach ($orders as $order) {
            // Setiap order dapat 2-4 item produk acak
            $itemsCount = rand(2, 4);
            $pickedProducts = $products->random($itemsCount);

            foreach ($pickedProducts as $product) {
                Order_items::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'qty' => rand(1, 3),
                    'price' => $product->price ?? rand(50000, 150000),
                ]);
            }
        }
    }
}
