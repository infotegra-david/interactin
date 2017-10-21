<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'view_users',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:44',
                'updated_at' => '2017-09-13 10:06:44',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'add_users',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:44',
                'updated_at' => '2017-09-13 10:06:44',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'edit_users',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:44',
                'updated_at' => '2017-09-13 10:06:44',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'delete_users',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:44',
                'updated_at' => '2017-09-13 10:06:44',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'view_roles',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'add_roles',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'edit_roles',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'delete_roles',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'view_interalliances',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'add_interalliances',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'edit_interalliances',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'delete_interalliances',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'view_interactions',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'add_interactions',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'edit_interactions',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'delete_interactions',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'view_interin',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'add_interin',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'edit_interin',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'delete_interin',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'view_interout',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'add_interout',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'edit_interout',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'delete_interout',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'view_countries',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'add_countries',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'edit_countries',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'delete_countries',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'view_states',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'add_states',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'edit_states',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'delete_states',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'view_cities',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'add_cities',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'edit_cities',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'delete_cities',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:45',
                'updated_at' => '2017-09-13 10:06:45',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'view_pasosalianzas',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'add_pasosalianzas',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'edit_pasosalianzas',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'delete_pasosalianzas',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'view_mails',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'add_mails',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'edit_mails',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'delete_mails',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'view_logs',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'add_logs',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'edit_logs',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'delete_logs',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'view_validations',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'add_validations',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'edit_validations',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'delete_validations',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'view_destination',
                'guard_name' => 'web',
                'created_at' => '2017-09-18 09:51:43',
                'updated_at' => '2017-09-18 09:51:43',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'add_destination',
                'guard_name' => 'web',
                'created_at' => '2017-09-18 09:51:43',
                'updated_at' => '2017-09-18 09:51:43',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'edit_destination',
                'guard_name' => 'web',
                'created_at' => '2017-09-18 09:51:43',
                'updated_at' => '2017-09-18 09:51:43',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'delete_destination',
                'guard_name' => 'web',
                'created_at' => '2017-09-18 09:51:43',
                'updated_at' => '2017-09-18 09:51:43',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'view_assignments',
                'guard_name' => 'web',
                'created_at' => '2017-09-19 12:25:40',
                'updated_at' => '2017-09-19 12:25:40',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'add_assignments',
                'guard_name' => 'web',
                'created_at' => '2017-09-19 12:25:40',
                'updated_at' => '2017-09-19 12:25:40',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'edit_assignments',
                'guard_name' => 'web',
                'created_at' => '2017-09-19 12:25:40',
                'updated_at' => '2017-09-19 12:25:40',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'delete_assignments',
                'guard_name' => 'web',
                'created_at' => '2017-09-19 12:25:40',
                'updated_at' => '2017-09-19 12:25:40',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'view_institutions',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:51:40',
                'updated_at' => '2017-09-26 13:51:40',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'add_institutions',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:51:41',
                'updated_at' => '2017-09-26 13:51:41',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'edit_institutions',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:51:41',
                'updated_at' => '2017-09-26 13:51:41',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'delete_institutions',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:51:41',
                'updated_at' => '2017-09-26 13:51:41',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'view_campus',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:03',
                'updated_at' => '2017-09-26 13:55:03',
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'add_campus',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:03',
                'updated_at' => '2017-09-26 13:55:03',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'edit_campus',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:03',
                'updated_at' => '2017-09-26 13:55:03',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'delete_campus',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:03',
                'updated_at' => '2017-09-26 13:55:03',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'view_faculties',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:14',
                'updated_at' => '2017-09-26 13:55:14',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'add_faculties',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:14',
                'updated_at' => '2017-09-26 13:55:14',
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'edit_faculties',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:14',
                'updated_at' => '2017-09-26 13:55:14',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'delete_faculties',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:14',
                'updated_at' => '2017-09-26 13:55:14',
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'view_programs',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:23',
                'updated_at' => '2017-09-26 13:55:23',
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'add_programs',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:23',
                'updated_at' => '2017-09-26 13:55:23',
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'edit_programs',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:23',
                'updated_at' => '2017-09-26 13:55:23',
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'delete_programs',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:23',
                'updated_at' => '2017-09-26 13:55:23',
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'view_subjects',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:38',
                'updated_at' => '2017-09-26 13:55:38',
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'add_subjects',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:38',
                'updated_at' => '2017-09-26 13:55:38',
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'edit_subjects',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:38',
                'updated_at' => '2017-09-26 13:55:38',
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'delete_subjects',
                'guard_name' => 'web',
                'created_at' => '2017-09-26 13:55:38',
                'updated_at' => '2017-09-26 13:55:38',
            ),
        ));
        
        
    }
}