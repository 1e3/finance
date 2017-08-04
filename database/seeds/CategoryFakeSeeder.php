<?php

use App\Domains\Categories\Category;
use Illuminate\Database\Seeder;

class CategoryFakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => $faker->name,
            ]);
        }

    }
}
