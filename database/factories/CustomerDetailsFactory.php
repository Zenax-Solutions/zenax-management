<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\CustomerDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'businuss_name' => $this->faker->text(255),
            'email' => $this->faker->email,
            'number' => $this->faker->randomNumber,
            'address' => $this->faker->address,
            'about' => $this->faker->text,
            'qoutation' => $this->faker->text,
            'customer_id' => \App\Models\Customer::factory(),
        ];
    }
}
