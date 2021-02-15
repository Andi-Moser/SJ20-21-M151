<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => 'Produkt ' . Str::random(5),
            'price' => rand(100, 1000) / 10,
            'details' => Str::words(50),
            'manual' => Str::words(50),
            'image' => 'image.jpg'
        ];
    }
}
