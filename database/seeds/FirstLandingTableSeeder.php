<?php

use Illuminate\Database\Seeder;

class FirstLandingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('first_landing')->delete();
        
        \DB::table('first_landing')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ten_hours' => '1000',
                'fourty_five_min' => '0045',
                'twelve_thirty' => '1230',
                'five_hours' => '0500',
                'twelve_hours' => '1200',
                'one_hour_thirty_min' => '0130',
                'fourteen_thirty' => '1430',
                'two_thirty' => '0230',
                'remember_token' => NULL,
                'created_at' => '2016-09-27 16:34:02',
                'updated_at' => '0000-00-00 00:00:00',
            ),
        ));
        
        
    }
}
