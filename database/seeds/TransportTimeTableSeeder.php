<?php

use Illuminate\Database\Seeder;

class TransportTimeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('transport_time')->delete();
        
        \DB::table('transport_time')->insert(array (
            0 => 
            array (
                'id' => 1,
                'transport_time' => '0030',
                'remember_token' => NULL,
                'created_at' => '2016-04-21 18:30:00',
                'updated_at' => '2016-04-21 18:30:00',
            ),
            1 => 
            array (
                'id' => 2,
                'transport_time' => '0045',
                'remember_token' => NULL,
                'created_at' => '2016-04-21 18:30:00',
                'updated_at' => '2016-04-21 18:30:00',
            ),
        ));
        
        
    }
}
