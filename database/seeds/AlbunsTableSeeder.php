<?php

use Illuminate\Database\Seeder;

class AlbunsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "*******",
            'email' => "******@gmail.com",
            'password' => bcrypt("******"),
        ]);
    }
}
