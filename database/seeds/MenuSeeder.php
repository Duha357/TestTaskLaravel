<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->insert([
            ['title' => 'Главная страница', 'route_name' => '',],
            ['title' => 'Каталог статей', 'route_name' => 'articles',],
        ]);
    }
}
