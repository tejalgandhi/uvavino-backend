<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use GemaDigital\Framework\app\Helpers\EnumHelper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $this->faker->addProvider(new PicsumPhotosProvider($this->faker));

        $r = rand(1, 100);
        $date = $this->faker->dateTimeBetween('-2 months', 'now');
        $title = $this->faker->text(35);

        // DEFAULT VIDEO URL
        $video_url = ['https://youtube.com/watch?v=FP_EW1zO2jo'];

        // GALLERY
        $gallery = [];
        $n = rand(4, 12);
        for ($x = 0; $x <= $n; $x++) {
            array_push($gallery, $this->faker->imageUrl(370, 215, true));
        }

        return [
            'slug' => \Str::slug($title),
            'title' => $title,
            'content' => $this->faker->text(1200),
            'image' => 'http://lorempixel.com/640/480/',
            'link' => null,
            'images' => $r > 25 && $r < 75 ? $gallery : null,
            'videos' => $r > 50 ? $video_url : null,
            'documents' => null,
            'status' => $this->faker->randomElement(EnumHelper::values('general.publish')),
            'category_id' => $this->faker->randomElement(Category::pluck('id')->toArray()),
            'featured' => $this->faker->numberBetween(0, 1),
            'date' => $date,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
