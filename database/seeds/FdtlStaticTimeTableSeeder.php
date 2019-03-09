<?php

use Illuminate\Database\Seeder;

class FdtlStaticTimeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fdtl_static_time')->delete();
        
        \DB::table('fdtl_static_time')->insert(array (
            0 => 
            array (
                'id' => 1,
                'reporting_time' => '-45 minutes',
                'flight_time' => '+10 minutes',
                'chocks_off' => '-5 minutes',
                'chocks_on' => '+5 minutes',
                'duty_end_time' => '+15 minutes',
                'is_active' => 1,
                'remember_token' => NULL,
                'created_at' => '2016-04-19 00:00:00',
                'updated_at' => '2016-04-19 00:00:00',
            ),
        ));
        
        
    }
}
