<?php

use App\Domains\Users\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'André Galdino',
            'email' => 'andre@galdino.com',
            'password' => bcrypt('test123')
        ]);

        User::create([
            'name' => 'Rafael Franco',
            'email' => 'rafael@franco.com',
            'password' => bcrypt('test123')
        ]);

        User::create([
            'name' => 'Danilo Guerra',
            'email' => 'danilo@guerra.com',
            'password' => bcrypt('test123')
        ]);

        User::create([
            'name' => 'Julia Viana',
            'email' => 'julia@viana.com',
            'password' => bcrypt('test123')
        ]);
    }
}
