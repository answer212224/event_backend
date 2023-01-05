<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MrtMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {

        $transportation = implode(',', $this->faker->randomElements(['公車', '捷運', '步行', '自行車', '機車', '計程車', '自行開車'], rand(0, 7)));
        return [
            'name' => $this->faker->name,
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'phone' => $this->faker->numerify('09########'),
            'outer_code' => $this->faker->numerify('8###############'),
            'transportation' => $transportation,
            'is_covid' => $this->faker->randomElement(['會', '不會', '']),
            'is_lottery' =>  $this->faker->randomElement(['會', '不會', '']),
            'ip' => $this->faker->ipv4,
        ];
    }
}
