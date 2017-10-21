<?php

use Illuminate\Database\Seeder;

class FormatoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('formato')->delete();
        
        \DB::table('formato')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'application/pdf',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'IMAGEN',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'pdf',
                'created_at' => '2017-07-13 15:33:21',
                'updated_at' => '2017-07-13 15:33:21',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'sql',
                'created_at' => '2017-07-17 10:38:42',
                'updated_at' => '2017-07-17 10:38:42',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'html',
                'created_at' => '2017-09-28 14:41:55',
                'updated_at' => '2017-09-28 14:41:55',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'jpg',
                'created_at' => '2017-09-28 14:41:55',
                'updated_at' => '2017-09-28 14:41:55',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'jpeg',
                'created_at' => '2017-09-28 14:41:55',
                'updated_at' => '2017-09-28 14:41:55',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'png',
                'created_at' => '2017-09-28 14:41:55',
                'updated_at' => '2017-09-28 14:41:55',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}