<?php

use Illuminate\Database\Seeder;

class PasosInscripcionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pasos_inscripcion')->delete();
        
        
    }
}