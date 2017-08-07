<?php

use Illuminate\Database\Seeder;
use App\Domains\Payments\Payment;
class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'price' => 62.5,
            'paid_at' => \Carbon\Carbon::today(),
            'status' => 0,
            'user_id' => 1,
            'invoice_id' => 4
        ]);

        Payment::create([
            'price' => 62.5,
            'paid_at' => \Carbon\Carbon::today(),
            'status' => 0,
            'user_id' => 2,
            'invoice_id' => 4
        ]);

        Payment::create([
            'price' => 70,
            'paid_at' => \Carbon\Carbon::today()->addMonth(),
            'status' => 0,
            'user_id' => 1,
            'invoice_id' => 4
        ]);

        Payment::create([
            'price' => 65,
            'paid_at' => \Carbon\Carbon::today()->addMonth(),
            'status' => 0,
            'user_id' => 2,
            'invoice_id' => 4
        ]);

        Payment::create([
            'price' => 70.50,
            'paid_at' => \Carbon\Carbon::today()->addMonth(2),
            'status' => 1,
            'user_id' => 1,
            'invoice_id' => 4
        ]);

        Payment::create([
            'price' => 80,
            'paid_at' => \Carbon\Carbon::today()->addMonth(2),
            'status' => 1,
            'user_id' => 2,
            'invoice_id' => 4
        ]);
    }
}
