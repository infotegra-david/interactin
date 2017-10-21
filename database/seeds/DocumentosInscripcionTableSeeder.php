<?php

use Illuminate\Database\Seeder;

class DocumentosInscripcionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('documentos_inscripcion')->delete();
        
        
        
    }
}