<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\MrtMember;
use App\Models\MrtRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class MrtRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = Carbon::createFromFormat('Y-m-d', '2022-07-01')->startOfDay();
        // $endDate = Carbon::createFromFormat('Y-m-d', '2022-10-31')->endOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', '2022-07-31')->endOfDay();
        // $mrtMembers = MrtMember::get()->random(1)->first();
        $mrtMembers = MrtMember::find(2);
        return [
            'type' => $this->faker->randomElement(['一般', '敬老1', '愛心', '學生', '優待']),
            'internal_code' => $this->faker->numerify('#########'),
            'outer_code' =>  function (array $attributes) use ($mrtMembers) {
                return $mrtMembers->outer_code;
            },
            // 'outer_code' =>  '1111111111111111',
            'recorded_at' => $this->faker->dateTimeBetween($startDate, $endDate)
        ];
    }
}
