<?php

use Illuminate\Database\Seeder;

class MailTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mail')->delete();
        
        
        
    }
}