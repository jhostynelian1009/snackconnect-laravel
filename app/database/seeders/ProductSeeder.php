<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::query()->pluck('id', 'slug');

        $products = [
            ['name' => 'Doritos', 'slug' => 'doritos', 'category' => 'salados', 'price' => 2.50, 'stock' => 40],
            ['name' => 'Cheetos', 'slug' => 'cheetos', 'category' => 'salados', 'price' => 2.30, 'stock' => 35],
            ['name' => 'Oreo', 'slug' => 'oreo', 'category' => 'dulces', 'price' => 1.80, 'stock' => 50],
            ['name' => 'Coca Cola', 'slug' => 'coca-cola', 'category' => 'bebidas', 'price' => 1.50, 'stock' => 60],
            ['name' => 'Pringles', 'slug' => 'pringles', 'category' => 'salados', 'price' => 3.20, 'stock' => 25],
            ['name' => 'Galletas', 'slug' => 'galletas', 'category' => 'dulces', 'price' => 1.20, 'stock' => 45],
            ['name' => 'Muffins', 'slug' => 'muffins', 'category' => 'saludables', 'price' => 2.80, 'stock' => 20],
            ['name' => 'Café', 'slug' => 'cafe', 'category' => 'bebidas', 'price' => 2.00, 'stock' => 30],
        ];

        foreach ($products as $product) {
            $categoryId = $categories[$product['category']] ?? null;

            if ($categoryId === null) {
                continue;
            }

            Product::query()->updateOrCreate(
                ['slug' => $product['slug']],
                [
                    'category_id' => $categoryId,
                    'name' => $product['name'],
                    'description' => 'Producto de ejemplo para el catálogo SnackConnect.',
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'is_active' => true,
                    'image' => null,
                ]
            );
        }
    }
}
