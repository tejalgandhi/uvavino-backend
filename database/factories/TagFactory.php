<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Providers\FakerServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new FakerServiceProvider($this->faker));

        return [
            'name' => $this->faker->tag(),
        ];
    }
}
