<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'is_active' => true,
        ]);

        DB::table('roles')->insert([
            'name' => 'editor',
            'display_name' => 'Editor',
            'is_active' => true,
        ]);

        DB::table('roles')->insert([
            'name' => 'user',
            'display_name' => 'User',
            'is_active' => true,
        ]);
    }
}
