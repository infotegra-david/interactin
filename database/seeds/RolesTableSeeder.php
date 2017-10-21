<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'administrador',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:46',
                'updated_at' => '2017-09-13 10:06:46',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'director_programa',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:48',
                'updated_at' => '2017-09-13 10:06:48',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'coordinador_externo',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:49',
                'updated_at' => '2017-09-13 10:06:49',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'coordinador_interno',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:49',
                'updated_at' => '2017-09-13 10:06:49',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'profesor',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:49',
                'updated_at' => '2017-09-13 10:06:49',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'validador',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:50',
                'updated_at' => '2017-09-13 10:06:50',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'representante_legal',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:50',
                'updated_at' => '2017-09-13 10:06:50',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'creador_iniciativa',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:51',
                'updated_at' => '2017-09-13 10:06:51',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'aliado_iniciativa',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:51',
                'updated_at' => '2017-09-13 10:06:51',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'estudiante',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:51',
                'updated_at' => '2017-09-13 10:06:51',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'particular',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:51',
                'updated_at' => '2017-09-13 10:06:51',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'copia_oculta_email',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:51',
                'updated_at' => '2017-09-13 10:06:51',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'generar_documento',
                'guard_name' => 'web',
                'created_at' => '2017-09-13 10:06:52',
                'updated_at' => '2017-09-13 10:06:52',
            ),
        ));
        
        
    }
}