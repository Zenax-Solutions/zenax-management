<?php

namespace Database\Factories;

use App\Models\FacebookAd;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacebookAdFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FacebookAd::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'content' => $this->faker->text,
            'type' => $this->faker->word,
            'status' => $this->faker->text(255),
            'reach' => $this->faker->randomNumber(0),
            'leads' => $this->faker->randomNumber(0),
            'cost' => $this->faker->randomNumber(0),
        ];
    }
}
