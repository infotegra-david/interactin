<?php

use Illuminate\Database\Seeder;

class EstadoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('estado')->delete();
        
        \DB::table('estado')->insert(array (
            

            0 => 
            array (
                'id' => 1,
                'nombre' =>  'EN PROCESO',
                'uso' => 'PROCESS',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' =>  'VENCIDA',
                'uso' => 'PROCESS',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' =>  'ACTIVA',
                'uso' => 'PROCESS',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),

            3 => 
            array (
                'id' => 4,
                'nombre' => 'PENDIENTE POR REVISIÓN',
                'uso' => 'USER',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'ACTUALIZACIÓN DE DATOS',
                'uso' => 'USER',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'INCOMPLETO',
                'uso' => 'USER',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'ACEPTADO',
                'uso' => 'EXTERNAL',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'DECLINADO',
                'uso' => 'EXTERNAL',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),

            8 => 
            array (
                'id' => 9,
                'nombre' => 'EN REVISIÓN',
                'uso' => 'VALIDATOR',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'RECHAZADO',
                'uso' => 'VALIDATOR',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'APROBADO',
                'uso' => 'VALIDATOR',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'nombre' =>  'GENERAR DOCUMENTO',
                'uso' => 'VALIDATOR',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'nombre' =>  'ACTIVA',
                'uso' => 'VALIDATOR',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),

        ));
        
        
    }
}