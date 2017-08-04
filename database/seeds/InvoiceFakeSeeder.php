<?php

use Illuminate\Database\Seeder;
use \App\Domains\Invoices\Invoice;

class InvoiceFakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Domains\Users\User::all();
        $categories = \App\Domains\Categories\Category::all();
        $house = \App\Domains\Houses\House::all()->first();

        for ($i = 0; $i < 10; $i++) {
            $faker = \Faker\Factory::create();
            Invoice::create([
                'price' => $faker->randomFloat(2,5,200),
                'description' => $faker->sentence(20),
                'user_id' => $users->random()->id,//userCreator
                'user_payment_id' => $users->random()->id,//userWhoPaid
                'category_id' => $categories->random()->id,
                'house_id' => $house->id,
                'parcels'  => $faker->numberBetween(1,12),
                'bought_at' => $faker->dateTimeThisMonth()
            ]);
        }
    }
}
