<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Soporte',
                'email' => 'soporte@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'kOP2JAZobihfak1sjbYwN5T3DoJ2LQVAGVvmsMfKMWfEoDKqYxTXMyQq9kyr',
                'datos_personales_id' => 1,
                'activo' => 0,
                'created_at' => '1990-01-01 01:01:01',
                'updated_at' => '2017-08-23 17:05:17',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Director de programa',
                'email' => 'director_programa@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 2,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:22',
                'updated_at' => '2017-06-15 09:21:12',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Coordinador Externo',
                'email' => 'coordinador_externo@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 3,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:22',
                'updated_at' => '2017-06-15 09:15:22',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Coordinador Interno',
                'email' => 'coordinador_interno@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 4,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:22',
                'updated_at' => '2017-06-15 09:15:22',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Profesor',
                'email' => 'profesor@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 5,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:22',
                'updated_at' => '2017-06-15 09:15:22',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Validador3',
                'email' => 'validador3@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 6,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-07-21 19:21:47',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Representante Legal',
                'email' => 'representante_legal@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 7,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-06-15 09:15:23',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Creador Iniciativa',
                'email' => 'creador_iniciativa@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 8,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-06-15 09:15:23',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Aliado Iniciativa',
                'email' => 'aliado_iniciativa@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 9,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-06-15 09:15:23',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Estudiante',
                'email' => 'estudiante@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 10,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-06-15 09:15:23',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Particular',
                'email' => 'particular@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 11,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-06-15 09:15:23',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'copia oculta emails',
                'email' => 'copia_oculta_emails@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 12,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-06-15 09:15:23',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'ORII',
                'email' => 'orii@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 13,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-06-15 09:15:23',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Vicerrectoría Académica',
                'email' => 'vrac@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 14,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-06-15 09:15:23',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Oficina de Admisiones y Registro',
                'email' => 'oar@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 15,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-06-15 09:15:23',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Santo Tomas',
                'email' => 'interactin@usta.edu.co',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 16,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-06-15 09:15:23',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Javeriana',
                'email' => 'interactin@ausjal.edu.co',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 17,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-06-15 09:15:23',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Validador1',
                'email' => 'validador1@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 18,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-07-21 19:21:47',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Validador2',
                'email' => 'validador2@interactin.com',
                'password' => '$2y$10$9ixcusNJHLWSmva2Y5jKp.zHbNzh1d2BsU.qwhBAry6ZcBPTXDkcm',
                'remember_token' => 'zlAD2Xhhugny6EXEiWzTNhAEpPSUzgW9p4fEI3mvepfqfs01NNO9z2WUGnWG',
                'datos_personales_id' => 19,
                'activo' => 0,
                'created_at' => '2017-06-15 09:15:23',
                'updated_at' => '2017-07-21 19:21:47',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}