<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomerDetails;

class CustomerDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerDetails::factory()
            ->count(5)
            ->create();
    }
}
