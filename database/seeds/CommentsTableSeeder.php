<?php

use App\Post;
use App\User;
use App\Comment;
use Illuminate\Database\Seeder;
use Faker\Factory;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $comments = [];

        $posts = Post::get();

        $usersId = User::pluck('id')->toArray();

        foreach ($posts as $post) {
            for ($i = 1; $i <= rand(1, 30); $i++) {
                $commentDate = $post->published_at->modify(" + {$i} hours");

                $comments[] = [
                    'post_id' => $post->id,
                    'parent_id' => rand(1, 10),
                    'user_id' => array_rand($usersId),
                    'body' => $faker->paragraphs(rand(1, 2), true),
                    'rating' => rand(-20, 20),
                    'is_posted' => 1,
                    'created_at' => $commentDate,
                    'updated_at' => $commentDate,
                ];
            }
        }

        Comment::truncate();
        Comment::insert($comments);

        //update the posts data
        foreach (Comment::pluck('id') as $commentId) {

            $usersId = User::pluck('id')->toArray();

            DB::table('user_like_comment')->insert([
                'user_id'     => array_rand($usersId),
                'comment_id'  => $commentId,
            ]);
        }


    }
}
