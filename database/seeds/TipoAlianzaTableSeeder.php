<?php

use Illuminate\Database\Seeder;

class TipoAlianzaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipo_alianza')->delete();
        
        \DB::table('tipo_alianza')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Marco',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Especifico',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}