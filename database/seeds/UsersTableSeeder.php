<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset the users table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();

        //generate 3 users/author
        $faker = Factory::create();

        // standard name
        $user = [
            [
                'id' => 1,
                'name' => 'administrator',
                'slug' => 'user-administrator',
                'email' => 'admin@admin.com',
                'password' => bcrypt('secret'),
            ],
            [
                'id' => 2,
                'name' => 'user',
                'slug' => 'user-user',
                'email' => 'user@user.com',
                'password' => bcrypt('secret'),
            ],
            [
                'id' => 3,
                'name' => 'editor',
                'slug' => 'user-editor',
                'email' => 'editor@editor.com',
                'password' => bcrypt('secret'),
            ],
        ];

        for ($i = 4; $i < 20; $i++) {
            $name = $faker->name;

            $user[$i] = [
                'id' => $i,
                'name' => $name,
                'slug' => str_slug($name, '-'),
                'email' => $faker->email,
                'password' => bcrypt('secret'),
            ];
        }

        DB::table('users')->insert(
            $user
        );

        foreach ($user as $u) {
            if ($u['id'] == 1) {
                $u = User::find($u['id']);
                $u->roles()->attach(1);
            } elseif ($u['id'] == 3) {
                $u = User::find($u['id']);
                $u->roles()->attach(2);
            } else {
                $u = User::find($u['id']);
                $u->roles()->attach(3);
            }
        }
    }
}
