<?php

use Illuminate\Database\Seeder;

class CampusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('campus')->delete();
        
        \DB::table('campus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'bogota',
                'institucion_id' => 1,
                'telefono' => '1234567',
                'direccion' => 'calle 12 # 132-12',
                'codigo_postal' => '32154',
                'email' => 'contacto@usta.com',
                'ciudad_id' => 153,
                'principal' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'otro campus santo tomas',
                'institucion_id' => 1,
                'telefono' => '123465',
                'direccion' => 'asdfsadfsadfsf',
                'codigo_postal' => '213165',
                'email' => 'lakjsdf@asdf.com',
                'ciudad_id' => 132,
                'principal' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'CALI',
                'institucion_id' => 2,
                'telefono' => '1234567',
                'direccion' => 'calle 12 # 132-12',
                'codigo_postal' => '123457',
                'email' => 'contacto@ausjal.com',
                'ciudad_id' => 1008,
                'principal' => 1,
                'created_at' => NULL,
                'updated_at' => '2017-09-18 14:46:02',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'otro campus javeriana',
                'institucion_id' => 2,
                'telefono' => '123465',
                'direccion' => 'asdfsadfsadfsf',
                'codigo_postal' => '213165',
                'email' => 'lakjsdf@asdf.com',
                'ciudad_id' => 1009,
                'principal' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}