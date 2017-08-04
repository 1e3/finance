<?php

use App\Domains\Categories\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Comida'
        ]);

        Category::create([
            'name' => 'Casa'
        ]);

        Category::create([
            'name' => 'Entreterimento'
        ]);

        Category::create([
            'name' => 'Transporte'
        ]);

        Category::create([
            'name' => 'Construção'
        ]);
    }
}
