<?php

use Illuminate\Database\Seeder;

class InscripcionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('inscripcion')->delete();
        
        
    }
}