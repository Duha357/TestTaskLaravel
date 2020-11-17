<?php

use App\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            DB::table('tags')->insert([
                'tag' => $faker->word,
            ]);
        }

        $articles = Article::all();

        foreach ($articles as $article) {
            $article->tags()->attach([1, 2, 3, 4, 5]);
        }
    }
}
