<?php

use Illuminate\Database\Seeder;
use \App\Domains\Houses\House;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $house = House::create([
            'name' => 'Casa Nossa'
        ]);
        $house->residents()->sync([
            1=>['admin'=>true],
            2=>['admin'=>true],
            3=>['admin'=>true],
            4=>['admin'=>true]]);
    }
}
