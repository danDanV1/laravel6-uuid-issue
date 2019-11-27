<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $user = app()->make('App\User');
        $user->name = $faker->firstName;
        $user->email = $faker->email;
        $user->password = "foo";
        $user->save();

        $post = app()->make('App\Post');
        $post->title = $faker->text(200);
        $post->user()->associate($user);
        $post->save();
    }
}
