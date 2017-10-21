<?php

use Illuminate\Database\Seeder;

class TipoFacultadTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipo_facultad')->delete();
        
        \DB::table('tipo_facultad')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'FACULTAD',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'UNIDAD',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}