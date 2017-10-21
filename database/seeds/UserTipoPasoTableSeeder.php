<?php

use Illuminate\Database\Seeder;

class UserTipoPasoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_tipo_paso')->delete();
        
        \DB::table('user_tipo_paso')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tipo_paso_id' => 6,
                'user_id' => 18,
                'orden' => 1,
                'titulo' => 'Director de programa',
                'created_at' => '2017-07-13 18:07:32',
                'updated_at' => '2017-07-13 18:07:32',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'tipo_paso_id' => 6,
                'user_id' => 19,
                'orden' => 2,
                'titulo' => 'Rectoría',
                'created_at' => '2017-07-13 18:07:45',
                'updated_at' => '2017-08-02 14:32:27',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'tipo_paso_id' => 6,
                'user_id' => 6,
                'orden' => 3,
                'titulo' => 'Abogados',
                'created_at' => '2017-07-13 18:07:54',
                'updated_at' => '2017-08-02 14:32:39',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'tipo_paso_id' => 6,
                'user_id' => 12,
                'orden' => 1,
                'titulo' => 'copia_oculta_emails',
                'created_at' => '2017-08-10 00:00:00',
                'updated_at' => '2017-08-10 00:00:00',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'tipo_paso_id' => 10,
                'user_id' => 18,
                'orden' => 1,
                'titulo' => 'Director de programa',
                'created_at' => '2017-08-10 00:00:00',
                'updated_at' => '2017-08-10 00:00:00',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'tipo_paso_id' => 10,
                'user_id' => 12,
                'orden' => 1,
                'titulo' => 'copia_oculta_emails',
                'created_at' => '2017-08-02 14:34:25',
                'updated_at' => '2017-08-22 02:49:12',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'tipo_paso_id' => 20,
                'user_id' => 18,
                'orden' => 1,
                'titulo' => 'Director de programa',
                'created_at' => '2017-08-02 14:34:25',
                'updated_at' => '2017-08-22 02:49:12',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'tipo_paso_id' => 20,
                'user_id' => 13,
                'orden' => 2,
                'titulo' => 'ORII',
                'created_at' => '2017-08-02 14:34:25',
                'updated_at' => '2017-08-22 02:49:12',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'tipo_paso_id' => 20,
                'user_id' => 5,
                'orden' => 3,
                'titulo' => 'Universidad/Institución de destino',
                'created_at' => '2017-08-02 14:34:25',
                'updated_at' => '2017-08-22 02:49:12',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'tipo_paso_id' => 20,
                'user_id' => 12,
                'orden' => 1,
                'titulo' => 'copia_oculta_emails',
                'created_at' => '2017-08-10 00:00:00',
                'updated_at' => '2017-08-10 00:00:00',
                'deleted_at' => NULL,
            ),

            10 => 
            array (
                'id' => 11,
                'tipo_paso_id' => 21,
                'user_id' => 13,
                'orden' => 1,
                'titulo' => 'ORII',
                'created_at' => '2017-08-02 14:34:25',
                'updated_at' => '2017-08-22 02:49:12',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'tipo_paso_id' => 21,
                'user_id' => 14,
                'orden' => 2,
            'titulo' => 'Vicerrectoría Académica (VRAC)',
                'created_at' => '2017-08-02 14:34:25',
                'updated_at' => '2017-08-22 02:49:12',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'tipo_paso_id' => 21,
                'user_id' => 15,
                'orden' => 3,
            'titulo' => 'Oficina de Admisiones y Registro (OAR)',
                'created_at' => '2017-08-02 14:34:25',
                'updated_at' => '2017-08-22 02:49:12',
                'deleted_at' => NULL,
            ),

            13 => 
            array (
                'id' => 14,
                'tipo_paso_id' => 21,
                'user_id' => 13,
                'orden' => 1,
                'titulo' => 'ORII',
                'created_at' => '2017-08-10 00:00:00',
                'updated_at' => '2017-08-10 00:00:00',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'tipo_paso_id' => 21,
                'user_id' => 12,
                'orden' => 1,
                'titulo' => 'copia_oculta_emails',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}