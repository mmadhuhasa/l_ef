<?php

use Illuminate\Database\Seeder;

class TotalFdpTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('total_fdp')->delete();
        
        \DB::table('total_fdp')->insert(array (
            0 => 
            array (
                'id' => 1,
                'no_of_plans' => '1',
                'fdp' => '1230',
                'max_12hours_for_min_rest_period' => '1200',
                'remember_token' => NULL,
                'created_at' => '2016-05-06 09:47:51',
                'updated_at' => '2016-04-18 18:30:00',
            ),
            1 => 
            array (
                'id' => 2,
                'no_of_plans' => '2',
                'fdp' => '1230',
                'max_12hours_for_min_rest_period' => '1200',
                'remember_token' => NULL,
                'created_at' => '2016-05-06 09:48:01',
                'updated_at' => '2016-04-18 18:30:00',
            ),
            2 => 
            array (
                'id' => 3,
                'no_of_plans' => '3',
                'fdp' => '1230',
                'max_12hours_for_min_rest_period' => '1200',
                'remember_token' => NULL,
                'created_at' => '2016-05-06 09:48:04',
                'updated_at' => '2016-04-18 18:30:00',
            ),
            3 => 
            array (
                'id' => 4,
                'no_of_plans' => '4',
                'fdp' => '1200',
                'max_12hours_for_min_rest_period' => '1200',
                'remember_token' => NULL,
                'created_at' => '2016-05-06 09:48:07',
                'updated_at' => '2016-04-18 18:30:00',
            ),
            4 => 
            array (
                'id' => 5,
                'no_of_plans' => '5',
                'fdp' => '1130',
                'max_12hours_for_min_rest_period' => '1200',
                'remember_token' => NULL,
                'created_at' => '2016-05-06 09:48:09',
                'updated_at' => '2016-04-18 18:30:00',
            ),
            5 => 
            array (
                'id' => 6,
                'no_of_plans' => '6',
                'fdp' => '1100',
                'max_12hours_for_min_rest_period' => '1200',
                'remember_token' => NULL,
                'created_at' => '2016-05-06 09:48:12',
                'updated_at' => '2016-04-18 18:30:00',
            ),
        ));
        
        
    }
}
