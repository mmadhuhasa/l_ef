<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 4,
                'name' => 'VTDVG',
                'email' => 'poovizhi.dscl@gmail.com',
                'password' => '$2y$10$bxny2/eGwIwznzJWSWecj.JLKeFYesY642VA409cknx2ZxhFaJ2nm',
                'mobile_number' => '9035222995',
                'operator' => 'DAVANAGERE SUGAR COMPANY',
                'remember_token' => '96h0cTHWAjcQMxAueLTQzmST1HvgXajEP7uslDhu932yibJcoZQcFUiRoYPK',
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 00:29:35',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            1 => 
            array (
                'id' => 6,
                'name' => 'EFLIGHT ADMIN',
                'email' => 'opseflight1@gmail.com',
                'password' => '$2y$10$ABoih4C4VcCAIM41G3aLeeBAbSZAHgAnam9z.alg3VDUUbfaX7H6y',
                'mobile_number' => '1234567890',
                'operator' => 'EFLIGHT SERVICES',
                'remember_token' => NULL,
                'is_admin' => 1,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-04-11 22:10:30',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            2 => 
            array (
                'id' => 12,
                'name' => 'Jupiter',
                'email' => 'flightops@jupitermail.in',
                'password' => '$2y$10$SMZP63a3eHDfO6G.WXP8x.tuNi7BconhkCqJoDJNKVZH.wrRlZVHq',
                'mobile_number' => '9538810724',
                'operator' => 'Jupiter Aviation',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:30:47',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            3 => 
            array (
                'id' => 13,
                'name' => 'Capt. Arvind',
                'email' => 'arvind.aviation@gmail.com',
                'password' => '$2y$10$tqK2M0ajsm8yssD4atceeuy8d89OX502mRsOppkKNvlEyyIO6dcQW',
                'mobile_number' => '9035098720',
                'operator' => 'Agni AeroSports',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:32:22',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            4 => 
            array (
                'id' => 15,
                'name' => 'Capt Kartik',
                'email' => 'kartik.subramaniam@gmail.com',
                'password' => '$2y$10$rcWvZ.61568b5uZEXODHje01ckM/LT48WjI54jPuPHVqDHCrJ40a2',
                'mobile_number' => '9500989098',
                'operator' => 'TVS Motor Company',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:34:05',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            5 => 
            array (
                'id' => 21,
                'name' => 'Capt Nerurkar',
                'email' => 'anant@ehasl.co.in',
                'password' => '$2y$10$dUMQ2m9hIz.HKwHOEB0C5elLeCi5.ALUShnrIexOYAjlgjyvrBf7a',
                'mobile_number' => '9840368006',
                'operator' => 'EHASL',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:34:48',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            6 => 
            array (
                'id' => 22,
                'name' => 'Mr Khan',
                'email' => 'wrkhan64@gmail.com',
                'password' => '$2y$10$OR9echCsgnhGJ/WNT5L4KeO.oMHGOOK7RFlR8L6ekiHBfIrYeV8QC',
                'mobile_number' => '9958848282',
                'operator' => 'VISION AVIATION',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:35:28',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            7 => 
            array (
                'id' => 25,
                'name' => 'Hosur ATC',
                'email' => 'hosuratc@taal.co.in',
                'password' => '$2y$10$0TA7Os6e2esGYS1wbvRR5unh4atMv6fhqFgRHzhOK96RCp844pbZ.',
                'mobile_number' => '9791696838',
                'operator' => 'TAAL',
                'remember_token' => 'GxZsA4onQyGJSMwKHKutfsxEFnAMTxti2N1214WGCwptxOhPDKSZ75L9rlGG',
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:36:45',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            8 => 
            array (
                'id' => 26,
                'name' => 'Satish',
                'email' => 'satish@titanaviation.co.in',
                'password' => '$2y$10$BXWhGrlDj5k4ZzUTNxVeGemv0uMsthJbvQOW15rQu1ysrunLO3ybu',
                'mobile_number' => '9496019082',
                'operator' => 'KALYAN JEWELLERS',
                'remember_token' => 'hrddbraAUcbdCPRJ2v71dSCTaTrVQcYmlIxXDf7UHTDfFrBrrVM3RN3MDwJc',
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:37:21',
                'updated_at' => '2016-04-26 06:49:47',
            ),
            9 => 
            array (
                'id' => 27,
                'name' => 'GOPINATH',
                'email' => 'askgopi@gmail.com',
                'password' => '$2y$10$ysf.vDco8PUVIbwisM.6x.HxJnZaG6nXxnjJShIRwUxkhXTBNyAi.',
                'mobile_number' => '9841413060',
                'operator' => 'COROMANDEL TRAVELS',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:37:58',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            10 => 
            array (
                'id' => 28,
                'name' => 'HARSHIT',
                'email' => 'hsinghal07@gmail.com',
                'password' => '$2y$10$ZcAQyhG4N88f8BHsDRO5MeoDwkuTgSbyObZ1PBlq9aQ86Bh6awXj6',
                'mobile_number' => '9840731933',
                'operator' => 'EHASL',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:36:09',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            11 => 
            array (
                'id' => 29,
                'name' => 'Capt. MARCO',
                'email' => 'bagmarco@yahoo.it',
                'password' => '$2y$10$W.EEw1ibthmno9mqignUseFmvl0g5K/ixM83HyyWJJf1K7gmji3tm',
                'mobile_number' => '9940681071',
                'operator' => 'EHASL',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:33:15',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            12 => 
            array (
                'id' => 30,
                'name' => 'VTEHT',
                'email' => 'chandru4861@gmail.com',
                'password' => '$2y$10$pUgD9GA35BWfK.hsurfTJuov574p/oPsMayFZtdKoYdkFHmsMFPfW',
                'mobile_number' => '9952918880',
                'operator' => 'EMERALD HAVEN',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:38:43',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            13 => 
            array (
                'id' => 34,
                'name' => 'MANOJ',
                'email' => 'manoj@joyjetsindia.com',
                'password' => '$2y$10$uO9jj5oiapLtvG5XMmpjDuqEGZN9N.XRbAjzc/0UeYpKjqe1oPbmS',
                'mobile_number' => '9846070260',
                'operator' => 'JOY JETS',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:39:21',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            14 => 
            array (
                'id' => 35,
                'name' => 'GVHL',
                'email' => 'operations@gvhl.net',
                'password' => '$2y$10$LlUNv0EV8.nACG1zdNrTzOjDIaajLtoJW50S3ZSIEOPVFjoqaEAoK',
                'mobile_number' => '9820395902',
                'operator' => 'GLOBAL VECTRA HELICORP',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:41:00',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            15 => 
            array (
                'id' => 38,
                'name' => 'SK DEY',
                'email' => 'sk.dey@ossair.com',
                'password' => '$2y$10$xhkVUI6ZRk4X1oLdYyRkzOd06j5UC8zFqYR30EMzrHoKYqDpSIc92',
                'mobile_number' => '9971666879',
                'operator' => 'OSS AIR',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:41:41',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            16 => 
            array (
                'id' => 39,
                'name' => 'VOJK TOWER',
                'email' => 'atc.gfts.kar@gmail.com',
                'password' => '$2y$10$xp0UcMSgoC/iLL2o0FN/v.DpGOUJh/Ub7O2ybdxwyMJ9YNUsRg3ae',
                'mobile_number' => '8023332251',
                'operator' => 'GFTS',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:42:34',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            17 => 
            array (
                'id' => 45,
                'name' => 'PRAVEEN',
                'email' => 'prv747@gmail.com',
                'password' => '$2y$10$pDZJiMDgM0vFeWbWoFDEBOWpMQu8zzrgXQydq81PpS5bcpqKCip/a',
                'mobile_number' => '9821206741',
                'operator' => 'KUBASE',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:46:12',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            18 => 
            array (
                'id' => 46,
                'name' => 'muhsin',
                'email' => 'muhsin1@sensomate.com',
                'password' => '$2y$10$V4GCQjuCH69YJdhJOcaWf.uGGhFFoY7RVm/PwyOBtS.y1/28a3imO',
                'mobile_number' => '9745786257',
                'operator' => 'king fisher',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 14:55:24',
                'updated_at' => '2016-04-11 14:18:41',
            ),
            19 => 
            array (
                'id' => 47,
                'name' => 'Prasad Jade',
                'email' => 'prasadjade.bangalore@gmail.com',
                'password' => '$2y$10$X6mPXP3Rn8xqAfzaoNhxo.H8Rzy9VmL9mukBjGDXOBfY5vGcZd0Qu',
                'mobile_number' => '8884494355',
                'operator' => 'VRL Logistics',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:47:46',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            20 => 
            array (
                'id' => 48,
                'name' => 'Viswa Pacers',
                'email' => 'viswapacers@gmail.com',
                'password' => '$2y$10$ORztOuQKZx2osjg/BVWMouMubnw/5mzLqCXzNobUM66o.LIsaOXNW',
                'mobile_number' => '9742128096',
                'operator' => 'VRL',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:48:22',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            21 => 
            array (
                'id' => 50,
                'name' => 'VTUSO',
                'email' => 'ramesh.rao@aopa.in',
                'password' => '$2y$10$c4WMYtMh4B2bOiJz1.xdAe7jAwFCx0zeO.EDo9tTV6xNc8xz0UZHK',
                'mobile_number' => '9845003248',
                'operator' => 'Ramesh Rao',
                'remember_token' => 'o71LNi71G2tSloy9IEpdfJMAfKYTD0x7GRUtuMgvr4NRu8flBPcr6ASDOaYQ',
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:49:01',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            22 => 
            array (
                'id' => 51,
                'name' => 'Capt Bala',
                'email' => 'capt.bala@myjet.in',
                'password' => '$2y$10$1sE2pNJ9GlhD5Bv76ZUCpe.WyFVNP1ob2VWHKpvU2X6rP3UuMQUz.',
                'mobile_number' => '9677120499',
                'operator' => 'VM AVIATION',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:50:17',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            23 => 
            array (
                'id' => 52,
                'name' => 'EFLIGHT OPS1',
                'email' => 'opseflight2@gmail.com',
                'password' => '$2y$10$hbBAL/FHV83HKBmw8hV.Z.jHAPoQNEP5PGAWcrZVwhbO2eqGtohRy',
                'mobile_number' => '1234512345',
                'operator' => 'EFLIGHT OPS',
                'remember_token' => 'PSs1fFeSHdXyv8bfMKJATvqmKa1Jhbw8AcRM7kXuwLnq6lSY3FZa7NHMK4qO',
                'is_admin' => 1,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-04-11 22:11:52',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            24 => 
            array (
                'id' => 55,
                'name' => 'Capt Bhullar',
                'email' => 'balrajsbhullar@gmail.com',
                'password' => '$2y$10$fhEgKBb//EP.Z.JSVjsmHuPShW162ebPHN4k2zXzS/cnW37iOOdSW',
                'mobile_number' => '8800195340',
                'operator' => 'SAIL',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:51:57',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            25 => 
            array (
                'id' => 56,
                'name' => 'Ramesh',
                'email' => 'ramesh.mopidevi@pravahya.com',
                'password' => '$2y$10$d.I/vP63dLJbWdALvCCOxeZZJKOqoMxCsFMuedMDBRrgTanbUDFL2',
                'mobile_number' => '9036069933',
                'operator' => 'Mopidevi',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:52:31',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            26 => 
            array (
                'id' => 58,
                'name' => 'CAPT RAY',
                'email' => 'ray2766@gmail.com',
                'password' => '$2y$10$l6..J/rzt1R5Z.qarbW/MeMTrfIxol.JYyNZZELAZMNE7uvti8jIO',
                'mobile_number' => '9431128580',
                'operator' => 'SAIL',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:53:59',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            27 => 
            array (
                'id' => 59,
                'name' => 'NAMIT',
                'email' => 'aviation.adag@yahoo.co.in',
                'password' => '$2y$10$N.DVzYRNFEap086DyZ/OE.m1lUKvwQErC6WVRxWy5CQIZropobosC',
                'mobile_number' => '9022223556',
                'operator' => 'RELIANCE TRANSPORT',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:43:18',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            28 => 
            array (
                'id' => 61,
                'name' => 'Deepak',
                'email' => 'deepak8970@yahoo.co.in',
                'password' => '$2y$10$.WEkxXh6ogxLpPLSnjuN9.e/hkUpilz7WwwFx5xvXou9crNLvpxHK',
                'mobile_number' => '8756462858',
                'operator' => 'UP GOVT',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:55:26',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            29 => 
            array (
                'id' => 62,
                'name' => 'PRAVIN',
                'email' => 'KUBADE.PRAVIN@mahindra.com',
                'password' => '$2y$10$G2pGyfnwrtgY5oNtoUX.DufoWkIIqjaCizfI1eyvO9LZtE4yezoFi',
                'mobile_number' => '9820703403',
                'operator' => 'Mahindra',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:56:01',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            30 => 
            array (
                'id' => 63,
                'name' => 'VINITHA',
                'email' => 'vinithamariappa@gmail.com',
                'password' => '$2y$10$An8LfYbCBx7AgTWiLK6B4eQmMoK5faSkbvSZdYDIsM1rz.k40an/u',
                'mobile_number' => '9845937599',
                'operator' => 'MARIAPPA',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:56:35',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            31 => 
            array (
                'id' => 64,
                'name' => 'NEVILLE',
                'email' => 'neville_bharucha@hotmail.com',
                'password' => '$2y$10$z/ZxuaboE9NkDiOyc6U/rOAWM3iQ0hJtGV3C9ipPQZNO4SH3RCwMy',
                'mobile_number' => '9225571905',
                'operator' => 'VTCJB',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:57:09',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            32 => 
            array (
                'id' => 65,
                'name' => 'VTTNT',
                'email' => 'spneuro@me.in',
                'password' => '$2y$10$DhdpwSpD/r4YWAuxseQ5Eegt5Dk8eI.DUapVpa2wrpj5yO9cBnkwu',
                'mobile_number' => '9823900112',
                'operator' => 'S Valsangkar',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:57:47',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            33 => 
            array (
                'id' => 66,
                'name' => 'NAUFIL',
                'email' => 'naufil_karnalkar@yahoo.com',
                'password' => '$2y$10$Sf01VccLDbDZpnlhGzSnPuOw9fxeozAxiQILPvKlYYF9ikTuPxwSC',
                'mobile_number' => '9766229099',
                'operator' => 'TNT ',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:58:29',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            34 => 
            array (
                'id' => 67,
                'name' => 'ROHIT',
                'email' => 'rohitsdevare.6@gmail.com',
                'password' => '$2y$10$KGeqLHVWfZuv1ZesuLtWQumxQifekEomTsJXH2wyE3hphvEoMtGHe',
                'mobile_number' => '8286450988',
                'operator' => 'S Valsangkar',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:59:07',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            35 => 
            array (
                'id' => 68,
                'name' => 'PRASAD BHAT',
                'email' => 'prasad@thermopac.in',
                'password' => '$2y$10$Lh4w04BWcEFNUHtSgm4HLu9r3MYkhS9BSW9vssIkEhzRDI/CSVPgq',
                'mobile_number' => '9821137879',
                'operator' => 'VTCJB',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:59:43',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            36 => 
            array (
                'id' => 69,
                'name' => 'VISHWAS',
                'email' => 'vbhisey@gmail.com',
                'password' => '$2y$10$RitnhD5LQipk.0nsLQme9.1EoonaIeauaw2ZpBO6gvE.WDa1O7bRi',
                'mobile_number' => '9373038585',
                'operator' => 'VTCJB',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 16:00:25',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            37 => 
            array (
                'id' => 72,
                'name' => 'K TOMAR',
                'email' => 'ks.tomar@jalindia.co.in',
                'password' => '$2y$10$BdsAD8gmgJ4KdiG/f3KQKua.fPPWtCHQ3fZc3hiYqwgok9gCD7MS6',
                'mobile_number' => '9810758608',
                'operator' => 'HIMALYAPUTRA',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 16:01:13',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            38 => 
            array (
                'id' => 74,
                'name' => 'CAPT ARUN',
                'email' => 'arunbharti4@gmail.com',
                'password' => '$2y$10$hBOk1FFNiBoGkPZ3dF9n2OfQLt7YltkyiQE1ogfBzpX9pWYBcTxBu',
                'mobile_number' => '9594155577',
                'operator' => 'EON AVIATION',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 16:03:10',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            39 => 
            array (
                'id' => 75,
                'name' => 'EFLIGHT OPS3',
                'email' => 'opseflight3@gmail.com',
                'password' => '$2y$10$0Bl9rOUQzOTHy.ENUqx2y.Qy1yBZEcqT3TXzfkfh143nIrW3tCVRa',
                'mobile_number' => '1234554321',
                'operator' => 'EFLIGHT OPS',
                'remember_token' => NULL,
                'is_admin' => 1,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-04-11 22:13:17',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            40 => 
            array (
                'id' => 77,
                'name' => 'Wg Cdr Santosh',
                'email' => 'vayushakti@gmail.com',
                'password' => '$2y$10$6Mhfv8YKPx.I1sNTWyM5Fuww.JATr82a7QC1uvMPmJWoPBex6AS52',
                'mobile_number' => '9845124158',
                'operator' => 'VTUSO',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 16:06:19',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            41 => 
            array (
                'id' => 79,
                'name' => 'Amitnath',
                'email' => 'amitnath@aerotechfms.com',
                'password' => '$2y$10$7fym7Oj4D3YABvHsVKbRuOgxrov6GH9PM51sBB.25UX54hl3JGi62',
                'mobile_number' => '9873520998',
                'operator' => 'AEROTECH FMS',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 15:54:46',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            42 => 
            array (
                'id' => 80,
                'name' => 'EFLIGHT OPS2',
                'email' => 'eflyteplan2@gmail.com',
                'password' => '$2y$10$Pq7jOYAfZjef8fKV7JOZoOn2q6waEg4syZpNVI1RxbjlQgwaCLmiS',
                'mobile_number' => '5432154321',
                'operator' => 'EFLYTE PLAN',
                'remember_token' => 'kZlECMgan1fnKrVR62LJ3Kqei4rHwpSsLBSv3cPcGRNyOTACIdi3xDTr0yxe',
                'is_admin' => 1,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-04-11 22:12:25',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            43 => 
            array (
                'id' => 81,
                'name' => 'EFLIGHT OPS4',
                'email' => 'opseflight4@gmail.com',
                'password' => '$2y$10$86Ym/Lj79.UDIFp5WMO7FOrYPQ3ECD6JPsroLwdcgFpYRqbvArLce',
                'mobile_number' => '1122334455',
                'operator' => 'EFLIGHT OPS',
                'remember_token' => NULL,
                'is_admin' => 1,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-04-11 22:13:47',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            44 => 
            array (
                'id' => 82,
                'name' => 'RAVI',
                'email' => 'ravi.tiwari@dbaviation.in',
                'password' => '$2y$10$8qc7baeaETDGMdSPTIDIx.QdQ3Vye7AaV4qEC8CdR2mfdSqyHilGK',
                'mobile_number' => '8962881354',
                'operator' => 'EXXOILS',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 16:07:59',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            45 => 
            array (
                'id' => 83,
                'name' => 'CAPT SALIL',
                'email' => 'captsalilsharma@gmail.com',
                'password' => '$2y$10$AkJBvQMHCBxGWEpRWZMoIuPScF55tQZCuuqp0Y1CHfbJT07gHP9eW',
                'mobile_number' => '7299429172',
                'operator' => 'KUNAL AIR',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 16:08:32',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            46 => 
            array (
                'id' => 84,
                'name' => 'CAPT SANJAY',
                'email' => 'captsanjay@sunnetwork.in',
                'password' => '$2y$10$tsvkHvv9NYsci7XVn2j/meant2DbhdeZw7sIpZZ8gaB52mGWzyzJu',
                'mobile_number' => '9600082191',
                'operator' => 'SUN NETWORK',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 16:09:09',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            47 => 
            array (
                'id' => 85,
                'name' => 'MAC',
                'email' => 'Macdonald.Creado@larsentoubro.com',
                'password' => '$2y$10$wHSsErWWF1/Rb947plmVXuNC.a74Yt1LQETdgVyIngXXHAKZ6pYoC',
                'mobile_number' => '9821111991',
                'operator' => 'L and T',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 16:09:41',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            48 => 
            array (
                'id' => 86,
                'name' => 'AKS',
                'email' => 'aksachdev@gmail.com',
                'password' => '$2y$10$dAruRWqNgOXfB7ZXaiI6SOJ4nuV5P8Ib2pl6zT/Oeh41CfsBZsWoS',
                'mobile_number' => '9886957557',
                'operator' => 'EFLIGHT AKS',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 16:10:22',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            49 => 
            array (
                'id' => 89,
                'name' => 'Anand',
                'email' => 'anand.vuppu@pravahya.com',
                'password' => '$2y$10$GY1P1Gc7.SQ7ZE0AVelyVeepExMyW1h8lAsBrIGomPUmoiGILmwGC',
                'mobile_number' => '9739939581',
                'operator' => 'Vuppu',
                'remember_token' => '7PXHrJEHNkWZNWmxK8UK4ZSFzpSXIu33dMH8yBn9IRdAooMcHoICy2ZFY3Qm',
                'is_admin' => 1,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-01-11 12:26:26',
                'updated_at' => '2016-05-02 13:02:27',
            ),
            50 => 
            array (
                'id' => 91,
                'name' => 'CAPT HARSHIT',
                'email' => 'fltops@globalkonnectair.com',
                'password' => '$2y$10$1dAOSUwzEpoSTyyxxcqdNOOjuRNSJHHxD9UFPulVoMeIKvXct5xoC',
                'mobile_number' => '9660957272',
                'operator' => 'Global Konnect',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-03-16 16:10:56',
                'updated_at' => '2016-04-26 12:10:56',
            ),
            51 => 
            array (
                'id' => 115,
                'name' => 'Prem',
                'email' => 'prem@eflight.aero',
                'password' => '$2y$10$EQHHD7ItrBGIfzy9EuIGqOdR7v7TV/Z27eIV932hiD3GmOPSsvoWy',
                'mobile_number' => '9886454717',
                'operator' => '',
                'remember_token' => 'JdlhvVxOj0OhiSim8ZreFwjuALFilUtdBjys5chA9RCSxvISk1DLmRIbGiwc',
                'is_admin' => 1,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-04-14 17:51:38',
                'updated_at' => '2016-04-20 15:31:54',
            ),
            52 => 
            array (
                'id' => 116,
                'name' => 'EFLIGHT OPS6',
                'email' => 'umayal4.s@gmail.com',
                'password' => '$2y$10$hex7FglhPYiltC5DhqVO4.hlk0NCMyaxjTDBAx/rdIihtSVVtlSiC',
                'mobile_number' => '9600999611',
                'operator' => 'EFLIGHT',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-05-03 09:43:27',
                'updated_at' => '2016-05-04 10:44:56',
            ),
            53 => 
            array (
                'id' => 117,
                'name' => 'EFLIGHT OPS5',
                'email' => 'nayimrashid@gmail.com',
                'password' => '$2y$10$bWnU.Rc1Jh20h2NYEiCbX.m3.0yu7WYjVz6t8Rwh..quIVcUU1qzS',
                'mobile_number' => '9037799151',
                'operator' => 'EFLIGHT',
                'remember_token' => NULL,
                'is_admin' => 0,
                'is_active' => 1,
                'is_delete' => 0,
                'is_app' => 0,
                'updated_by' => 0,
                'created_at' => '2016-05-03 09:42:38',
                'updated_at' => '2016-05-04 10:45:01',
            ),
        ));
        
        
    }
}