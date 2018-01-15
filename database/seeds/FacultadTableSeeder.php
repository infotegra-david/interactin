<?php

use Illuminate\Database\Seeder;

class FacultadTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('facultad')->delete();
        
        \DB::table('facultad')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Administración',
                'campus_id' => 1,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Arquitectura y Diseño',
                'campus_id' => 1,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Artes y Humanidades',
                'campus_id' => 1,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'Ciencias Económicas y Administrativas',
                'campus_id' => 1,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'Ciencias Naturales',
                'campus_id' => 1,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'Ciencias Sociales',
                'campus_id' => 1,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'Derecho',
                'campus_id' => 1,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'Educación',
                'campus_id' => 1,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'Ingeniería',
                'campus_id' => 1,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'Medicina',
                'campus_id' => 1,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'Administración',
                'campus_id' => 1,
                'tipo_facultad_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'nombre' => 'Docentes',
                'campus_id' => 1,
                'tipo_facultad_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'nombre' => 'Administración',
                'campus_id' => 2,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'nombre' => 'Arquitectura y Diseño',
                'campus_id' => 2,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'nombre' => 'Artes y Humanidades',
                'campus_id' => 2,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'nombre' => 'Ciencias Económicas y Administrativas',
                'campus_id' => 2,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'nombre' => 'Ciencias Naturales',
                'campus_id' => 2,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'nombre' => 'Ciencias Sociales',
                'campus_id' => 2,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'nombre' => 'Derecho',
                'campus_id' => 2,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'nombre' => 'Educación',
                'campus_id' => 2,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'nombre' => 'Ingeniería',
                'campus_id' => 2,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'nombre' => 'Medicina',
                'campus_id' => 2,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'nombre' => 'Administración',
                'campus_id' => 2,
                'tipo_facultad_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'nombre' => 'Docentes',
                'campus_id' => 2,
                'tipo_facultad_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'nombre' => 'Administración',
                'campus_id' => 3,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'nombre' => 'Arquitectura y Diseño',
                'campus_id' => 3,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'nombre' => 'Artes y Humanidades',
                'campus_id' => 3,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'nombre' => 'Ciencias Económicas y Administrativas',
                'campus_id' => 3,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'nombre' => 'Ciencias Naturales',
                'campus_id' => 3,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'nombre' => 'Ciencias Sociales',
                'campus_id' => 3,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'nombre' => 'Derecho',
                'campus_id' => 3,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'nombre' => 'Educación',
                'campus_id' => 3,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'nombre' => 'Ingeniería',
                'campus_id' => 3,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'nombre' => 'Medicina',
                'campus_id' => 3,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'nombre' => 'Administración',
                'campus_id' => 3,
                'tipo_facultad_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'nombre' => 'Docentes',
                'campus_id' => 3,
                'tipo_facultad_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'nombre' => 'Administración',
                'campus_id' => 4,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'nombre' => 'Arquitectura y Diseño',
                'campus_id' => 4,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'nombre' => 'Artes y Humanidades',
                'campus_id' => 4,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'nombre' => 'Ciencias Económicas y Administrativas',
                'campus_id' => 4,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'nombre' => 'Ciencias Naturales',
                'campus_id' => 4,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'nombre' => 'Ciencias Sociales',
                'campus_id' => 4,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'nombre' => 'Derecho',
                'campus_id' => 4,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'nombre' => 'Educación',
                'campus_id' => 4,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'nombre' => 'Ingeniería',
                'campus_id' => 4,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'nombre' => 'Medicina',
                'campus_id' => 4,
                'tipo_facultad_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'nombre' => 'Administración',
                'campus_id' => 4,
                'tipo_facultad_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'nombre' => 'Docentes',
                'campus_id' => 4,
                'tipo_facultad_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}