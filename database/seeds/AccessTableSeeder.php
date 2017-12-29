<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;

class AccessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('access')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('access')->insert([
            [
                'id' => 1,
                'status_name' => 'moderate',
            ],
            [
                'id' => 2,
                'status_name' => 'auth',
            ],
        ]);
    }
}
