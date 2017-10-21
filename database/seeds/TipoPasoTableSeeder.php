<?php

use Illuminate\Database\Seeder;

class TipoPasoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipo_paso')->delete();
        
        \DB::table('tipo_paso')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'paso1_alianza',
                'titulo' => 'Datos internos',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'paso2_alianza',
                'titulo' => 'Datos institución contraparte',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'paso3_alianza',
                'titulo' => 'Guardar/Enviar Pre-registro',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'paso4_alianza',
                'titulo' => 'Datos de la Institución Destino',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'paso5_alianza',
                'titulo' => 'Datos del representante legal externo',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'paso6_alianza',
                'titulo' => 'Guardar/Enviar Registro',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'paso1_interchange',
                'titulo' => 'Datos personales',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'paso2_interchange',
                'titulo' => 'Información Académica',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'paso3_interchange',
                'titulo' => 'Información de movilidad',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'paso4_interchange',
                'titulo' => 'Enviar la Pre-inscripción',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'paso5_interchange',
                'titulo' => 'Datos Personales',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'nombre' => 'paso6_interchange',
                'titulo' => 'Datos de Contacto',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'nombre' => 'paso7_interchange',
                'titulo' => 'Información Académica',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'nombre' => 'paso8_interchange',
                'titulo' => 'Información de movilidad',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'nombre' => 'paso9_interchange',
                'titulo' => 'Contacto en caso de emergencia',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'nombre' => 'paso10_interchange',
                'titulo' => 'Fuentes de financiación',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'nombre' => 'paso11_interchange',
                'titulo' => 'Presupuesto',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'nombre' => 'paso12_interchange',
                'titulo' => 'Documentos de Soporte',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'nombre' => 'paso13_interchange',
                'titulo' => 'Foto',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'nombre' => 'paso14_interchange',
                'titulo' => 'Guardar/Enviar Inscripción',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'nombre' => 'paso15_interchange',
                'titulo' => 'Cargar documentos finales',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}