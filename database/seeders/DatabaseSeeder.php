<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Parents;
use App\Models\Child;
use App\Models\Attendance;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        User::factory()
            ->count(20)
            ->has(
                Parents::factory()
                    ->count(1)
                    ->has(
                        Child::factory()
                            ->count(2)
                            ->has(
                                Attendance::factory()
                                    ->count(6)
                            )
                    )
            )
            ->create();

    }
}
