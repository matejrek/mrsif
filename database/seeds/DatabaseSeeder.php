<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RoutineSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(ExerciseSeeder::class);
        $this->call(ExerciseSectionSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(TrackerSeeder::class);
        $this->call(TrackerResultSeeder::class);
    }
}
