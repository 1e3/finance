<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseFakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserFakeSeeder::class);
        $this->call(CategoryFakeSeeder::class);
        $this->call(HouseFakeSeeder::class);
        Model::reguard();
    }
}
