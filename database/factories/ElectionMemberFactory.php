<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ElectionMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'udn' => $this->faker->bothify(),
            'email' => $this->faker->freeEmail(),
            'ip' => $this->faker->ipv4(),
            'is_app' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
