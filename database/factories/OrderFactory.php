<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $emojis = ['', '📢', '🥸', '🐶', '💓', '❗️'];
        $random_emoji = Arr::random($emojis);

        return [
            'email' => $this->faker->safeEmail,
            'order_number' => Str::upper(Str::random(12)),
            'product_name' => Str::of($this->faker->name)->append($random_emoji),
            'paid_at' => $this->faker->dateTime('now', 'UTC'),
        ];
    }
}
