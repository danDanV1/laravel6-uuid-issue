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

        $flower = app()->make('App\Flower');
        $flower->type = $faker->text(20);
        $flower->save();

        for ($i = 0; $i < 3; $i++) {
            $petal = app()->make('App\Petal');
            $petal->color = $faker->safeColorName();
            $petal->flower()->associate($flower);
            $petal->save();

            $post = app()->make('App\Post');
            $post->title = $faker->text(200);
            $post->user()->associate($user);
            $post->save();
        }

        $queryFlower = App\Flower::first();
        echo ("Found # of flowers: " . App\Flower::all()->count() . "\n");
        echo ("Found # of petals: " . App\Petal::all()->count() . "\n");
        echo ("Found # of flower->petals relations: " . $queryFlower->petals->count() . "\n");


        $queryUser = App\User::first();
        echo ("Found # of users: " . App\User::all()->count() . "\n");
        echo ("Found # of posts: " . App\Post::all()->count() . "\n");
        echo ("Found # of user->posts relations: " . $queryUser->posts->count() . "\n");
    }
}
