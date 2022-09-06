<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class ,
            ProductSeeder::class
        ]);

        \App\Models\User::factory(100)->create();

        \App\Models\Admin::create([
            'name' => 'kareem',
            'email' => 'admin@admin.com',
            'password' => Hash::make(123456789) , // password
            'verified' => 1
        ]);


    }
}
