<?php

use Illuminate\Database\Seeder;

class TipoPlantillaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipo_plantilla')->delete();
        
        \DB::table('tipo_plantilla')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'EMAIL - REGISTRO DATOS EL USUARIO',
                'clasificacion_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'EMAIL - RECHAZADO POR EL VALIDADOR',
                'clasificacion_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'EMAIL - APROBADO POR EL VALIDADOR',
                'clasificacion_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'EMAIL - ACTIVA POR EL VALIDADOR',
                'clasificacion_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'EMAIL - VENCIDA PARA INVOLUCRADOS',
                'clasificacion_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'EMAIL - ACTIVA PARA INVOLUCRADOS',
                'clasificacion_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'EMAIL - REGISTRO DATOS EL USUARIO',
                'clasificacion_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'EMAIL - RECHAZADO POR EL VALIDADOR',
                'clasificacion_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'EMAIL - APROBADO POR EL VALIDADOR',
                'clasificacion_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'EMAIL - ACTIVA POR EL VALIDADOR',
                'clasificacion_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'EMAIL - VENCIDA PARA INVOLUCRADOS',
                'clasificacion_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'nombre' => 'EMAIL - ACTIVA PARA INVOLUCRADOS',
                'clasificacion_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'nombre' => 'EMAIL - REGISTRO DATOS EL USUARIO',
                'clasificacion_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'nombre' => 'EMAIL - VENCIDA PARA INVOLUCRADOS',
                'clasificacion_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'nombre' => 'EMAIL - ACTIVA PARA INVOLUCRADOS',
                'clasificacion_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'nombre' => 'EMAIL - REGISTRO DATOS EL USUARIO',
                'clasificacion_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'nombre' => 'EMAIL - REGISTRO DATOS EL USUARIO EXTERNO',
                'clasificacion_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'nombre' => 'EMAIL - ACEPTADO POR EL USUARIO EXTERNO',
                'clasificacion_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'nombre' => 'EMAIL - DECLINADO POR EL USUARIO EXTERNO',
                'clasificacion_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'nombre' => 'EMAIL - RECHAZADO POR EL VALIDADOR',
                'clasificacion_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'nombre' => 'EMAIL - APROBADO POR EL VALIDADOR',
                'clasificacion_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'nombre' => 'EMAIL - ACTIVA POR EL VALIDADOR',
                'clasificacion_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'nombre' => 'EMAIL - VENCIDA PARA INVOLUCRADOS',
                'clasificacion_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'nombre' => 'EMAIL - ACTIVA PARA INVOLUCRADOS',
                'clasificacion_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}