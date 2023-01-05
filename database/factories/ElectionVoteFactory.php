<?php

namespace Database\Factories;

use App\Models\ElectionCandidate;
use Illuminate\Database\Eloquent\Factories\Factory;

class ElectionVoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'election_candidate_id' => random_int(1, 16),
            'ip' => $this->faker->ipv4(),
            'city' => $this->faker->randomElement(['Taipei', 'NewTaipei', 'Taoyuan', 'Taichung', 'Tainan', 'Kaoshiung']),
            'created_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
