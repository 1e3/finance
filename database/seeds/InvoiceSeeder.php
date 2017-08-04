<?php

use App\Domains\Invoices\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $house = \App\Domains\Houses\House::all()->first();


        //Invoice to all house's members
        $invoice1 = Invoice::create([
            'price' => 200.50,
            'description' => 'Comida para a semana',
            'user_id' => 1,
            'user_payment_id' => 1,
            'category_id' => 1,
            'house_id' => $house->id,
            'parcels'  => 1,
            'bought_at' => \Carbon\Carbon::today()
        ]);

        $invoice1->users()->sync([1,2,3,4]);


        $invoice2 = Invoice::create([
            'price' => 300.00,
            'description' => 'Madeiras Pallet',
            'user_id' => 3,
            'user_payment_id' => 3,
            'category_id' => 5,
            'house_id' => $house->id,
            'parcels'  => 1,
            'bought_at' => \Carbon\Carbon::today()
        ]);

        $invoice2->users()->sync([1,2,3,4]);


        $invoice3 = Invoice::create([
            'price' => 500.00,
            'description' => 'Geladeira',
            'user_id' => 2,
            'user_payment_id' => 2,
            'category_id' => 2,
            'house_id' => $house->id,
            'parcels'  => 1,
            'bought_at' => \Carbon\Carbon::today()
        ]);

        $invoice3->users()->sync([1,2,3,4]);

        $invoice4 = Invoice::create([
            'price' => 1500.00,
            'description' => 'PS4',
            'user_id' => 1,
            'user_payment_id' => 1,
            'category_id' => 3,
            'house_id' => $house->id,
            'parcels'  => 12,
            'bought_at' => \Carbon\Carbon::today()
        ]);

        $invoice4->users()->sync([1,2]);





    }
}
