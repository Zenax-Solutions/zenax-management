<?php

namespace Database\Factories;

use App\Models\Orders;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Orders::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'discount' => $this->faker->randomNumber(0),
            'total' => $this->faker->randomNumber,
            'payment_status' => $this->faker->text(255),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'order_status' => $this->faker->text,
            'customer_id' => \App\Models\Customer::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
