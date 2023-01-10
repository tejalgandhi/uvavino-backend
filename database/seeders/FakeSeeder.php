<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;

class FakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate tables
        Article::truncate();
        Category::truncate();
        Tag::truncate();
        DB::table('article_related')->truncate();
        DB::table('article_tag')->truncate();

        // Delete not admin users
        User::doesnthave('roles')->delete();

        // Set Auto increment
        $total = User::count();
        DB::statement('ALTER TABLE users AUTO_INCREMENT = '.($total + 1));

        // Users
        $this->log('Users');
        User::factory()->count(30 - $total)->create();

        // Categories
        $this->log('Categories');
        Category::factory()->count(50)->create();

        // Tags
        $this->log('Tags');
        Tag::factory()->count(50)->create();

        // Articles
        $this->log('Articles');
        Article::factory()
            ->count(30)
            ->create();

        // Articles Related
        $articles = Article::pluck('id', 'id')->toArray();
        $tags = Tag::pluck('id', 'id')->toArray();

        Article::all()->each(function ($article) use ($articles, $tags) {
            $article->articles()->sync(array_rand($articles, rand(1, 2)));
            $article->tags()->sync(array_rand($tags, rand(1, 2)));
        });
    }

    /**
     * Log to console
     *
     * @param string $entity
     * @return void
     */
    public function log(string $entity): void
    {
        echo "Seeding: Fake $entity\n";
    }
}
