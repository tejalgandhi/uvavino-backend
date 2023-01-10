<?php

namespace Database\Factories;

use App\Models\Category;
use App\Providers\FakerServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new FakerServiceProvider($this->faker));
        $name = $this->faker->unique()->category();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
