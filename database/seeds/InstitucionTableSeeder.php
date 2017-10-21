<?php

use Illuminate\Database\Seeder;

class InstitucionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('institucion')->delete();
        
        \DB::table('institucion')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'santo tomas',
                'email' => 'contacto@usta.edu.co',
                'tipo_institucion_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'javeriana',
                'email' => 'contacto@ausjal.edu.co',
                'tipo_institucion_id' => 1,
                'created_at' => NULL,
                'updated_at' => '2017-09-20 16:43:58',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}