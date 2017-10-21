<?php

use Illuminate\Database\Seeder;

class PeriodoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('periodo')->delete();
        
        \DB::table('periodo')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'PRIMER SEMESTRE DE 2017',
                'fecha_desde' => '2017-01-01',
                'fecha_hasta' => '2017-06-30',
                'vigente' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'MITAD DE AÑO DE 2017',
                'fecha_desde' => '2017-06-01',
                'fecha_hasta' => '2017-07-30',
                'vigente' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'SEGUNDO SEMESTRE DE 2017',
                'fecha_desde' => '2017-07-01',
                'fecha_hasta' => '2017-12-30',
                'vigente' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'PRIMER SEMESTRE DE 2018',
                'fecha_desde' => '2018-01-01',
                'fecha_hasta' => '2018-06-30',
                'vigente' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'MITAD DE AÑO DE 2018',
                'fecha_desde' => '2018-06-01',
                'fecha_hasta' => '2018-07-30',
                'vigente' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'SEGUNDO SEMESTRE DE 2018',
                'fecha_desde' => '2018-07-01',
                'fecha_hasta' => '2018-12-30',
                'vigente' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}