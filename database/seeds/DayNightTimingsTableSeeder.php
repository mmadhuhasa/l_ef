<?php

use Illuminate\Database\Seeder;

class DayNightTimingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('day_night_timings')->delete();
        
        \DB::table('day_night_timings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'day_time_from' => '0600',
                'day_time_to' => '2159',
                'night_time_from' => '2200',
                'night_time_to' => '0559',
                'remember_token' => NULL,
                'created_at' => '2016-04-19 06:11:56',
                'updated_at' => '2016-04-18 18:30:00',
            ),
            1 => 
            array (
                'id' => 2,
                'day_time_from' => '0030',
                'day_time_to' => '1630',
                'night_time_from' => '1631',
                'night_time_to' => '0029',
                'remember_token' => NULL,
                'created_at' => '2016-04-23 08:38:11',
                'updated_at' => '0000-00-00 00:00:00',
            ),
        ));
        
        
    }
}
