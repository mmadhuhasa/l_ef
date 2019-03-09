<?php

use Illuminate\Database\Seeder;

class UserRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        \DB::table('user_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'PILOT',
                'is_active' => 1
            )
        ));
        
        
    }
}
