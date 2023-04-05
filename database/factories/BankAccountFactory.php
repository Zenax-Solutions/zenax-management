<?php

namespace Database\Factories;

use App\Models\BankAccount;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankAccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BankAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account_name' => $this->faker->text(255),
            'account_number' => $this->faker->randomNumber(0),
            'amount' => $this->faker->randomNumber(0),
            'withdrawal' => $this->faker->randomNumber(0),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
