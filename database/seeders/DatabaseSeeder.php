<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $category_titles = ['Laravel','Vue JS', 'Rest API'];

        foreach ($category_titles as $key => $category_title) {
            Category::create(['title'=>$category_title]);
        }
        
    }
}
