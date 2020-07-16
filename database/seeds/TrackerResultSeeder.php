<?php

use Illuminate\Database\Seeder;

class TrackerResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TrackerResult::class,120)->create();
    }
}
