<?php

use Illuminate\Database\Seeder;
use App\CheckIn;

class CheckinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CheckIn::insert(
            [
                [
                    'user_id' => 1,
                    'time' => 1632198027,
                    'session' => 'morning'
                ],
            ]
        );
    }
}
