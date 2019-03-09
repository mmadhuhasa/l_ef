<?php

use Illuminate\Database\Seeder;

class StationAddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('station_addresses')->delete();
        
        \DB::table('station_addresses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'chennai' => 'VOMF',
                'mumbai' => 'VABF',
                'kolkata' => 'VECF',
                'delhi' => 'VIDF',
                'created_at' => '2015-12-30 14:44:23',
                'updated_at' => '2015-12-30 14:44:23',
            ),
            1 => 
            array (
                'id' => 2,
                'chennai' => 'VOMM',
                'mumbai' => 'VABB',
                'kolkata' => 'VECC',
                'delhi' => 'VIDP',
                'created_at' => '2015-12-30 14:44:23',
                'updated_at' => '2015-12-30 14:44:23',
            ),
            2 => 
            array (
                'id' => 3,
                'chennai' => '',
                'mumbai' => 'VABBYFYF',
                'kolkata' => '',
                'delhi' => 'VIDPZIZX',
                'created_at' => '2015-12-30 14:44:23',
                'updated_at' => '2015-12-30 14:44:23',
            ),
        ));
        
        
    }
}
