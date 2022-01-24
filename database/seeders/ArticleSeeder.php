<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker=Faker::create();
      for ($i=0; $i <10 ; $i++) {
        $sentence=$faker->sentence(rand(6,9));
        DB::table('articles')->insert([
          'category_id'=>rand(1,7),
          'title'=>$sentence,
          'image'=>$faker->imageUrl(200,100),
          'content'=>$faker->paragraph(rand(5,10)),
          'slug'=>str_slug($sentence),
          'created_at'=>$faker->dateTime('now'),
          'updated_at'=>now()
        ]);
      }

    }
}
