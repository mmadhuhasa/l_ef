<?php

use Illuminate\Database\Seeder;

class DesignationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('designations')->delete();
        
        \DB::table('designations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Pilot',
                'comments' => '',
                'is_active' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-21 15:47:50',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Co-pilot',
                'comments' => '',
                'is_active' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-21 15:47:50',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Cabin Crew',
                'comments' => '',
                'is_active' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-21 15:51:35',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Client Operation 1',
                'comments' => '',
                'is_active' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-21 15:51:40',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Client Operation 2',
                'comments' => '',
                'is_active' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-21 15:51:44',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Client Operation 3',
                'comments' => '',
                'is_active' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-21 15:51:51',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Client Operation 4',
                'comments' => '',
                'is_active' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-21 15:51:51',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Client Operation 5',
                'comments' => '',
                'is_active' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-21 15:51:51',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Client Operation 6',
                'comments' => '',
                'is_active' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-21 15:51:51',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Client Operation 7',
                'comments' => '',
                'is_active' => 1,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-21 15:51:51',
            ),
        ));
        
        
    }
}
