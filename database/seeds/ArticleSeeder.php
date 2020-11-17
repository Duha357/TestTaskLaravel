<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            $fakeDate = $faker->date($format = 'Y-m-d', $max = 'now');

            DB::table('articles')->insert([
                'topic' => $faker->company,
                'text' => $faker->text,
                'created_at' => $fakeDate,
                'updated_at' => $fakeDate,
            ]);
        }
    }
}
