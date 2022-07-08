<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=OrmTableSeederでormテーブルにデータ追加
        DB::table('orms')->insert([
            ['sample1' => 'aa', 'sample2' => 'a1'],
            ['sample1' => 'bb', 'sample2' => 'b1'],
            ['sample1' => 'cc', 'sample2' => 'c1'],
            ['sample1' => 'dd', 'sample2' => 'd1'],
            ['sample1' => 'ee', 'sample2' => 'e1'],
            ['sample1' => 'ff', 'sample2' => 'f1'],
            ['sample1' => 'gg', 'sample2' => 'g1'],
            ['sample1' => 'hh', 'sample2' => 'h1'],
            ['sample1' => 'ii', 'sample2' => 'i1']
        ]);
    }
}
