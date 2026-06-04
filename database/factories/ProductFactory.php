<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productTypes = [
            'Laptop',
            'Mouse',
            'Keyboard',
            'Monitor',
            'Headset',
            'SSD',
            'Flashdisk',
            'Printer',
            'Speaker',
            'Smartphone'
        ];

    $brands = [
            'Asus',
            'Acer',
            'Samsung',
            'Logitech',
            'Kingston',
            'Xiaomi',
            'Canon',
            'Epson',
            'JBL',
            'Fantech'
        ];
         return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => fake()->randomElement($productTypes) . ' ' .
                    fake()->randomElement($brands),
            'description' => fake()->randomElement([
                'Produk berkualitas tinggi dengan garansi resmi.',
                'Cocok digunakan untuk kebutuhan sehari-hari.',
                'Memiliki performa yang baik dan tahan lama.',
                'Produk original dengan kualitas terbaik.',
                'Desain modern dan nyaman digunakan.',
                'Pilihan tepat untuk kebutuhan kerja maupun hiburan.',
                'Dilengkapi fitur terbaru dengan harga terjangkau.',
                'Produk favorit pelanggan dengan banyak ulasan positif.',
            ]),
            'price' => fake()->numberBetween(200000, 10000000),
            'image' => null,
        ];
    }
}
