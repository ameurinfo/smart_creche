<?php

namespace Database\Factories;

use App\Models\Child;
use App\Models\Parents;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');
        $startDate = '2024-01-01';
        $endDate = '2024-06-15';

        return [
            'date' => $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
            'child_id' => Child::factory(),
            'staff_id' => $faker->numberBetween(1, 3),
            'arrival_time' => $faker->time('H:i:s'),
            'departure_time' => $faker->optional()->time('H:i:s'), // Make departure time nullable
            'notes' => $faker->optional()->text(),
        ];
    }
}
