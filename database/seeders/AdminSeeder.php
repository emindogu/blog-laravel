<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('admins')->insert([
        'name'=>'Emin Doğu',
        'email'=>'emindogu@hotmail.com',
        'password'=> bcrypt('123456'),
      ]);
    }
}