<?php

use Illuminate\Database\Seeder;

class EmailTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('email')->delete();
        
        
        
    }
}