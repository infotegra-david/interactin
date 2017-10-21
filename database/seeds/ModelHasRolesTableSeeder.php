<?php

use Illuminate\Database\Seeder;

class ModelHasRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('model_has_roles')->delete();
        
        \DB::table('model_has_roles')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'model_id' => 1,
                'model_type' => 'App\\User',
            ),
            1 => 
            array (
                'role_id' => 1,
                'model_id' => 16,
                'model_type' => 'App\\User',
            ),
            2 => 
            array (
                'role_id' => 1,
                'model_id' => 17,
                'model_type' => 'App\\User',
            ),
            3 => 
            array (
                'role_id' => 1,
                'model_id' => 22,
                'model_type' => 'App\\User',
            ),
            4 => 
            array (
                'role_id' => 2,
                'model_id' => 2,
                'model_type' => 'App\\User',
            ),
            5 => 
            array (
                'role_id' => 3,
                'model_id' => 3,
                'model_type' => 'App\\User',
            ),
            6 => 
            array (
                'role_id' => 3,
                'model_id' => 23,
                'model_type' => 'App\\User',
            ),
            7 => 
            array (
                'role_id' => 4,
                'model_id' => 1,
                'model_type' => 'App\\User',
            ),
            8 => 
            array (
                'role_id' => 4,
                'model_id' => 4,
                'model_type' => 'App\\User',
            ),
            9 => 
            array (
                'role_id' => 4,
                'model_id' => 21,
                'model_type' => 'App\\User',
            ),
            10 => 
            array (
                'role_id' => 5,
                'model_id' => 5,
                'model_type' => 'App\\User',
            ),
            11 => 
            array (
                'role_id' => 6,
                'model_id' => 1,
                'model_type' => 'App\\User',
            ),
            12 => 
            array (
                'role_id' => 6,
                'model_id' => 5,
                'model_type' => 'App\\User',
            ),
            13 => 
            array (
                'role_id' => 6,
                'model_id' => 6,
                'model_type' => 'App\\User',
            ),
            14 => 
            array (
                'role_id' => 6,
                'model_id' => 13,
                'model_type' => 'App\\User',
            ),
            15 => 
            array (
                'role_id' => 6,
                'model_id' => 14,
                'model_type' => 'App\\User',
            ),
            16 => 
            array (
                'role_id' => 6,
                'model_id' => 15,
                'model_type' => 'App\\User',
            ),
            17 => 
            array (
                'role_id' => 7,
                'model_id' => 7,
                'model_type' => 'App\\User',
            ),
            18 => 
            array (
                'role_id' => 7,
                'model_id' => 19,
                'model_type' => 'App\\User',
            ),
            19 => 
            array (
                'role_id' => 7,
                'model_id' => 20,
                'model_type' => 'App\\User',
            ),
            20 => 
            array (
                'role_id' => 7,
                'model_id' => 25,
                'model_type' => 'App\\User',
            ),
            21 => 
            array (
                'role_id' => 8,
                'model_id' => 8,
                'model_type' => 'App\\User',
            ),
            22 => 
            array (
                'role_id' => 9,
                'model_id' => 9,
                'model_type' => 'App\\User',
            ),
            23 => 
            array (
                'role_id' => 10,
                'model_id' => 10,
                'model_type' => 'App\\User',
            ),
            24 => 
            array (
                'role_id' => 10,
                'model_id' => 18,
                'model_type' => 'App\\User',
            ),
            25 => 
            array (
                'role_id' => 11,
                'model_id' => 11,
                'model_type' => 'App\\User',
            ),
            26 => 
            array (
                'role_id' => 12,
                'model_id' => 12,
                'model_type' => 'App\\User',
            ),
            27 => 
            array (
                'role_id' => 13,
                'model_id' => 1,
                'model_type' => 'App\\User',
            ),
            28 => 
            array (
                'role_id' => 13,
                'model_id' => 6,
                'model_type' => 'App\\User',
            ),
        ));
        
        
    }
}