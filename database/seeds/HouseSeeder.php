<?php

use App\Domains\Houses\House;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $house = House::create(['name' => $faker->name]);
        $users = App\Domains\Users\User::all();
        $house->residents()->sync($users->only('id'));
    }
}
