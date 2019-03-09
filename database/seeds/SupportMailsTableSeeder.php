<?php

use Illuminate\Database\Seeder;

class SupportMailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('support_mails')->delete();
        
        \DB::table('support_mails')->insert(array (
            0 => 
            array (
                'id' => 1,
                'to_mail_ids' => '',
                'cc_mail_ids' => 'support@eflight.aero,support@eflight.co.in',
                'bcc_mail_ids' => 'dev.eflight@pravahya.com,prem@eflight.aero',
                'local_mail_ids' => 'dev.eflight@pravahya.com',
                'is_bcc_active' => 1,
                'is_cc_active' => 1,
                'is_active' => 1,
                'created_at' => '2016-03-04 11:18:59',
                'updated_at' => '2016-04-20 16:33:20',
            ),
        ));
        
        
    }
}
