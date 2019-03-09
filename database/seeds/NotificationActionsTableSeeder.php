<?php

use Illuminate\Database\Seeder;

class NotificationActionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notification_actions')->delete();
        
        \DB::table('notification_actions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'action_name' => 'Flight Plan',
                'is_active' => 1,
                'is_delete' => 0,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-06 12:49:00',
            ),
            1 => 
            array (
                'id' => 2,
                'action_name' => 'Cancel Plan',
                'is_active' => 1,
                'is_delete' => 0,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-06 12:49:00',
            ),
            2 => 
            array (
                'id' => 3,
                'action_name' => 'Delay Plan',
                'is_active' => 1,
                'is_delete' => 0,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-06 12:49:00',
            ),
            3 => 
            array (
                'id' => 4,
                'action_name' => 'FIC ADC',
                'is_active' => 1,
                'is_delete' => 0,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-06 12:49:00',
            ),
            4 => 
            array (
                'id' => 5,
                'action_name' => 'Change Flight Plan',
                'is_active' => 1,
                'is_delete' => 0,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-06-06 12:49:00',
            ),
        ));
        
        
    }
}
