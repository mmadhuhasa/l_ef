<?php

use Illuminate\Database\Seeder;

class TotalFtTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('total_ft')->delete();
        
        \DB::table('total_ft')->insert(array (
            0 => 
            array (
                'id' => 1,
                'no_of_plans' => '1',
                'day' => '0900',
                'night' => '0900',
                'remember_token' => NULL,
                'created_at' => '2016-04-19 05:54:47',
                'updated_at' => '2016-04-18 18:30:00',
            ),
            1 => 
            array (
                'id' => 2,
                'no_of_plans' => '2',
                'day' => '0900',
                'night' => '0900',
                'remember_token' => NULL,
                'created_at' => '2016-04-19 05:54:55',
                'updated_at' => '2016-04-18 18:30:00',
            ),
            2 => 
            array (
                'id' => 3,
                'no_of_plans' => '3',
                'day' => '0900',
                'night' => '0800',
                'remember_token' => NULL,
                'created_at' => '2016-04-19 05:55:07',
                'updated_at' => '2016-04-18 18:30:00',
            ),
            3 => 
            array (
                'id' => 4,
                'no_of_plans' => '4',
                'day' => '0800',
                'night' => '0800',
                'remember_token' => NULL,
                'created_at' => '2016-04-19 05:55:27',
                'updated_at' => '2016-04-18 18:30:00',
            ),
            4 => 
            array (
                'id' => 5,
                'no_of_plans' => '5',
                'day' => '0800',
                'night' => '0800',
                'remember_token' => NULL,
                'created_at' => '2016-04-19 05:55:34',
                'updated_at' => '2016-04-18 18:30:00',
            ),
            5 => 
            array (
                'id' => 6,
                'no_of_plans' => '6',
                'day' => '0800',
                'night' => '0800',
                'remember_token' => NULL,
                'created_at' => '2016-04-19 05:55:41',
                'updated_at' => '2016-04-18 18:30:00',
            ),
        ));
        
        
    }
}
