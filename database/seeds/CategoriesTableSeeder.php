<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
            [
                'name' => 'Аналитика',
                'slug' => 'analytics',
                'access_id' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Экономика',
                'slug' => 'economy',
                'access_id' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Политика',
                'slug' => 'politics',
                'access_id' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'News',
                'slug' => 'news',
                'access_id' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Freebies',
                'slug' => 'freebies',
                'access_id' => 0,
                'is_active' => true,
            ],
        ]);

        //update the posts data
        foreach (Post::pluck('id') as $postId) {

            $categories = Category::pluck('id');
            $categoryId = $categories[rand(0, $categories->count()-1)];

            DB::table('post_category')->insert([
                'category_id' => $categoryId,
                'post_id'    => $postId,
            ]);
        }
    }
}
