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
        $cats = ['Mobiles' ,'Computers' , 'Clothes'];

        shuffle($cats);

        for ($i = 0 ; $i < count($cats) ; $i++) {

            Category::create([
                'name' => $cats[$i]
            ]); 

        }
    }
}
