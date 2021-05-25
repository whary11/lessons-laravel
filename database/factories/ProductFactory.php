<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->paragraph(2);
        return  [
            'name'           => $name,
            'description'    => $this->faker->paragraph(1),
            'slug'           => Str::slug($name),
            'stock'          => 10,
            'price'          => rand(1000, 100000),
            'image_url'      => $this->faker->imageUrl(),
            'status_id'      => 1,
        ];
    }
}
