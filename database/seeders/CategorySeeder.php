<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = ['Mobiles', 'Computers', 'Clothes'];
        $mobiles = ['iphone', 'samsung', 'sony'];
        $clothes = ['Polo', 'Round', 'jeans'];
        $Computers = ['Intel', 'Amd', 'sony'];

        shuffle($cats);

        for ($i = 0; $i < count($cats); $i++) {

            Category::create([
                'name' => $cats[$i],
                'parent' => 0
            ]);
        }

        for ($i = 0; $i < count($mobiles); $i++) {

            Category::create([
                'name' => $mobiles[$i],
                'parent' => array_search('Mobiles', $cats) + 1
            ]);
        }

        for ($i = 0; $i < count($clothes); $i++) {

            Category::create([
                'name' => $clothes[$i],
                'parent' => array_search('Clothes', $cats) + 1
            ]);
        }

        for ($i = 0; $i < count($Computers); $i++) {

            Category::create([
                'name' => $Computers[$i],
                'parent' => array_search('Computers', $cats) + 1
            ]);
        }
    }
}
