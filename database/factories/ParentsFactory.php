<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Parents;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parents>
 */
class ParentsFactory extends Factory
{
    protected $model = Parents::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('ar_SA');

        return [
            'name' => $faker->name,
            'relationship' => $faker->randomElement(['اﻷب', 'اﻷم', 'العم', 'الخالة', 'الخال']),
            'phone_number' => $faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'job' => $faker->jobTitle,
            'user_id' => User::factory(),
        ];
    }

    /**
     * Configure the factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Parents $parent) {
            $user = $parent->user;
            $roleParents = Role::firstOrCreate(['name' => 'parents', 'guard_name' => 'web']);
            $permissionsParents = [
                'follow_up_children',
                'children_information',
                'attendance_tracking',
                'meal_tracking',
                'sleep_tracking',
                'health_safety',
                'communicate_with_child'
            ];
            $roleParents->syncPermissions($permissionsParents);
            $user->assignRole($roleParents);
        });
    }
}
