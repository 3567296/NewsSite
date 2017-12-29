<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset the posts table
        DB::table('posts')->truncate();

        //generate 36 dummy posts data
        $posts = [];
        $faker = Factory::create();
        $date = Carbon::now()->modify('-1 year');

        for($i = 1; $i <= 36; $i++) {

            $image = "Post_Image_" . rand(1, 5) . ".jpg";
            $date->addDays(10);
            $publishedDate = clone($date);
            $createdDate = clone($date);

            $posts[] = [
                'user_id' => rand(1, 19),
                'name' => $faker->sentence(rand(8, 12)),
                'slug' => $faker->slug(),
                'body' => $faker->paragraphs(rand(10, 15), true),
                'image' => rand(0, 1) == 1 ? $image : null,
                'view_count' => rand(1, 10) * 10,
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
                'published_at' => $i < 30 ? $publishedDate : ( rand(0, 1) == 0 ? null : $publishedDate->addDays(4) ),
            ];
        }

        DB::table('posts')->insert($posts);

//        //reset the post_category table
//        DB::table('post_category')->truncate();


    }
}
