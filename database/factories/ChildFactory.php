<?php

namespace Database\Factories;

use App\Models\Child;
use App\Models\Parents;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class ChildFactory extends Factory
{
    protected $model = Child::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = FakerFactory::create('ar_SA');
        $gender = $faker->randomElement(['ذكر', 'أنثى']);

        return [
            'name' => $faker->firstName($gender) . ' ' . $faker->lastName,
            'birthdate' => $faker->dateTimeBetween('2020-01-01', '2024-01-01')->format('Y-m-d'),
            'gender' => $gender,
            'address' => $faker->address,
            'phone_number' => $faker->phoneNumber,
            'image' => NULL,
            'notes' => $faker->paragraph,
            'parents_id' => Parents::factory(),
        ];
    }
}
