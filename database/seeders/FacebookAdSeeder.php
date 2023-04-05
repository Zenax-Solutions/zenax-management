<?php

namespace Database\Seeders;

use App\Models\FacebookAd;
use Illuminate\Database\Seeder;

class FacebookAdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FacebookAd::factory()
            ->count(5)
            ->create();
    }
}
