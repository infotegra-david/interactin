<?php

use Illuminate\Database\Seeder;

class PostulacionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('postulacion')->delete();
                
        
    }
}