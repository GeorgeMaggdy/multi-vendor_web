<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        $name=$this->faker->productName;
        return [
          'name'=>$name,
          'slug'=>Str::slug($name),
          'description'=>$this->faker->sentence(15),
          'image'=>$this->faker->imageUrl(300,50),
          'price'=>$this->faker->randomFloat(1,1,500),
          'compare_price'=>$this->faker->randomFloat(1,550,999),
          'featured'=>rand(0,1),
          'category_id'=>Category::inRandomOrder()->first()->id,
          'store_id'=>Store::inRandomOrder()->first()->id ,



        ];  
    }
}
