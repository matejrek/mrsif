<?php

use Illuminate\Database\Seeder;
use App\Exercise;
use App\Section;

class ExerciseSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = App\Section::all();

        App\Exercise::all()->each(function ($exercise) use ($sections) {
            $exercise->sections()->attach(
                $sections->random(rand(1, 40))->pluck('id')->toArray()
            );
        });
    }
}
