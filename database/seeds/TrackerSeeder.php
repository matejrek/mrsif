<?php

use Illuminate\Database\Seeder;

class TrackerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tracker::class,1)->create();
    }
}
