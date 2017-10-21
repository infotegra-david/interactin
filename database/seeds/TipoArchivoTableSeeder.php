<?php

use Illuminate\Database\Seeder;

class TipoArchivoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipo_archivo')->delete();
        

        //SOLO DEVERIA EXISTIR COMO TIPO DE ARCHIVO ['DOCUMENTO','MULTIMEDIA','ARCHIVOS ADJUNTOS','PRE-FORMA']
        //LOS DEMAS SON MAS TIPOS DE DOCUMENTO Y NO DE ARCHIVO

        \DB::table('tipo_archivo')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'DOCUMENTO',
                'nativo' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'PRE-FORMA',
                'nativo' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'MULTIMEDIA',
                'nativo' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'ARCHIVOS ADJUNTOS',
                'nativo' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}