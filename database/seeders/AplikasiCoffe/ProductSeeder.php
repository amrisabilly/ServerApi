<?php

namespace Database\Seeders\AplikasiCoffe;

use Illuminate\Database\Seeder;
use App\Models\AplikasiCoffe\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                "category_id" => 1,
                "name" => "Espresso",
                "description" => "Kopi hitam pekat dengan rasa yang kuat.",
                "origin_story" => "Asal usul Espresso.",
                "price" => 18000,
                "image_url" => "https://images.unsplash.com/photo-1497935586351-b67a49e012bf?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Cappuccino",
                "description" => "Perpaduan espresso, susu panas, dan busa susu.",
                "origin_story" => "Asal usul Cappuccino.",
                "price" => 24000,
                "image_url" => "https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Caffè Latte",
                "description" => "Espresso dengan susu yang lembut (steamed milk).",
                "origin_story" => "Asal usul Caffè Latte.",
                "price" => 26000,
                "image_url" => "https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Americano",
                "description" => "Espresso yang ditambahkan air panas.",
                "origin_story" => "Asal usul Americano.",
                "price" => 20000,
                "image_url" => "https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Iced Coffee",
                "description" => "Kopi dingin menyegarkan dengan es batu.",
                "origin_story" => "Asal usul Iced Coffee.",
                "price" => 22000,
                "image_url" => "https://images.unsplash.com/photo-1559496417-e7f25cb247f3?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Macchiato",
                "description" => "Espresso dengan sedikit bubuk susu di atasnya.",
                "origin_story" => "Asal usul Macchiato.",
                "price" => 23000,
                "image_url" => "https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Mocha",
                "description" => "Kopi dengan campuran coklat dan susu.",
                "origin_story" => "Asal usul Mocha.",
                "price" => 25000,
                "image_url" => "https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Affogato",
                "description" => "Espresso dengan es krim vanila.",
                "origin_story" => "Asal usul Affogato.",
                "price" => 27000,
                "image_url" => "https://images.unsplash.com/photo-1610632380989-680fe40816c6?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Flat White",
                "description" => "Espresso dengan susu steamed tipis.",
                "origin_story" => "Asal usul Flat White.",
                "price" => 21000,
                "image_url" => "https://images.unsplash.com/photo-1498804103079-a6351b050096?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Irish Coffee",
                "description" => "Kopi dengan whiskey dan krim.",
                "origin_story" => "Asal usul Irish Coffee.",
                "price" => 32000,
                "image_url" => "https://images.unsplash.com/photo-1507133750069-69d3cdad5625?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Ristretto",
                "description" => "Espresso dengan air lebih sedikit.",
                "origin_story" => "Asal usul Ristretto.",
                "price" => 19000,
                "image_url" => "https://images.unsplash.com/photo-1512568400610-62da28bc8a13?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Doppio",
                "description" => "Double shot espresso.",
                "origin_story" => "Asal usul Doppio.",
                "price" => 28000,
                "image_url" => "https://images.unsplash.com/photo-1442512595367-427325327382?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Cortado",
                "description" => "Espresso dengan sedikit susu.",
                "origin_story" => "Asal usul Cortado.",
                "price" => 21000,
                "image_url" => "https://images.unsplash.com/photo-1524350876685-2740593328f3?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Red Eye",
                "description" => "Kopi hitam dengan tambahan espresso.",
                "origin_story" => "Asal usul Red Eye.",
                "price" => 23000,
                "image_url" => "https://images.unsplash.com/photo-1529892485617-25f63cd7b1e9?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Long Black",
                "description" => "Espresso dengan air panas lebih banyak.",
                "origin_story" => "Asal usul Long Black.",
                "price" => 20000,
                "image_url" => "https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Vienna Coffee",
                "description" => "Kopi dengan whipped cream.",
                "origin_story" => "Asal usul Vienna Coffee.",
                "price" => 29000,
                "image_url" => "https://images.unsplash.com/photo-1459755486867-b55449bb39ff?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Piccolo Latte",
                "description" => "Espresso dengan susu steamed dalam gelas kecil.",
                "origin_story" => "Asal usul Piccolo Latte.",
                "price" => 21000,
                "image_url" => "https://images.unsplash.com/photo-1485808191679-5f8c7c8606f4?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Cold Brew",
                "description" => "Kopi yang diseduh dingin selama beberapa jam.",
                "origin_story" => "Asal usul Cold Brew.",
                "price" => 25000,
                "image_url" => "https://images.unsplash.com/photo-1506372023823-d887b0937ed7?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Nitro Coffee",
                "description" => "Cold brew dengan nitrogen.",
                "origin_story" => "Asal usul Nitro Coffee.",
                "price" => 27000,
                "image_url" => "https://images.unsplash.com/photo-1504630083234-fdc441b6f999?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Turkish Coffee",
                "description" => "Kopi khas Turki dengan gula.",
                "origin_story" => "Asal usul Turkish Coffee.",
                "price" => 22000,
                "image_url" => "https://images.unsplash.com/photo-1497515114629-f71d768fd61c?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Kopi Gayo",
                "description" => "Kopi khas Aceh dengan aroma kuat.",
                "origin_story" => "Dataran tinggi Gayo.",
                "price" => 35000,
                "image_url" => "https://images.unsplash.com/photo-1484244233201-29877ebbcd4b?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Kopi Toraja",
                "description" => "Kopi Toraja dengan rasa earthy.",
                "origin_story" => "Pegunungan Toraja.",
                "price" => 37000,
                "image_url" => "https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Kopi Kintamani",
                "description" => "Kopi Bali dengan rasa citrus.",
                "origin_story" => "Kintamani, Bali.",
                "price" => 33000,
                "image_url" => "https://images.unsplash.com/photo-1522992319-0365e5f11656?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Kopi Mandailing",
                "description" => "Kopi Sumatra dengan body kuat.",
                "origin_story" => "Mandailing, Sumatra.",
                "price" => 34000,
                "image_url" => "https://images.unsplash.com/photo-1521302242790-cd4a3122c41b?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Kopi Papua",
                "description" => "Kopi Papua dengan rasa unik.",
                "origin_story" => "Pegunungan Papua.",
                "price" => 36000,
                "image_url" => "https://images.unsplash.com/photo-1579963333765-b4129b3250aa?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Kopi Lampung",
                "description" => "Kopi robusta khas Lampung.",
                "origin_story" => "Lampung, Sumatra.",
                "price" => 32000,
                "image_url" => "https://images.unsplash.com/photo-1578314675249-a6910f80cc4e?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Kopi Sidikalang",
                "description" => "Kopi arabika dari Sidikalang.",
                "origin_story" => "Sidikalang, Sumatra.",
                "price" => 34000,
                "image_url" => "https://images.unsplash.com/photo-1596443686813-952e3043815c?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 2,
                "name" => "Kopi Bali",
                "description" => "Kopi Bali dengan aroma floral.",
                "origin_story" => "Bali, Indonesia.",
                "price" => 33000,
                "image_url" => "https://images.unsplash.com/photo-1551033406-611cf9a28f67?auto=format&fit=crop&w=800&q=80"
            ],
            [
                "category_id" => 1,
                "name" => "Kopi Flores",
                "description" => "Kopi Flores dengan rasa fruity.",
                "origin_story" => "Flores, NTT.",
                "price" => 35000,
                "image_url" => "https://images.unsplash.com/photo-1561882468-411333c57159?auto=format&fit=crop&w=800&q=80"
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
