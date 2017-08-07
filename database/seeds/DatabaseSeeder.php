<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(HouseSeeder::class);
        $this->call(InvoiceSeeder::class);
        $this->call(PaymentSeeder::class);
        Model::reguard();
    }
}
