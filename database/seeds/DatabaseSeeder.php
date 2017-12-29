<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccessTableSeeder::class);

        if (env('APP_ENV') == 'local') {
            $this->call(UsersTableSeeder::class);
            $this->call(PostsTableSeeder::class);
            $this->call(CategoriesTableSeeder::class);
            $this->call(CommentsTableSeeder::class);
        }

        $this->call(RolesTableSeeder::class);
    }
}
