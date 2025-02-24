<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = ['Fiction', 'Action', 'Comedy', 'Romance', 'Drama'];

        foreach($categories as $c){
            Category::updateOrCreate(['name' => $c]);
        }
    }
}
