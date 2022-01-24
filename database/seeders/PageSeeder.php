<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    $pages=['Hakkımızda','Karıyer','Vizyonumuz','Misyonumuz'];
    $count=0;
    foreach ($pages as $page) {
      $count++;
      DB::table('pages')->insert([
        'title'=>$page,
        'slug'=>str_slug($page),
        'image'=>'https://www.ismailaga.org.tr/wp-content/uploads/2017/04/ust-header-ismailaga.jpg',
        'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'order'=>$count,
        'created_at'=> now(),
        'updated_at'=> now()
      ]);
    }
  }
}
