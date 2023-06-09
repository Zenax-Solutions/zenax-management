<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        $this->call(BankAccountSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CustomerDetailsSeeder::class);
        $this->call(FacebookAdSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(UserSeeder::class);
    }
}
