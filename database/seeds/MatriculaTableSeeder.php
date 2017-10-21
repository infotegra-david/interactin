<?php

use Illuminate\Database\Seeder;

class MatriculaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('matricula')->delete();
        
        
    }
}