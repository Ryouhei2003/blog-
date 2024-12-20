<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
     /**
     * Seed the application's datebase.
     */
    

     public function run(): void
     {
        $this->call(CategorySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
    }
}