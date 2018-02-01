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
                'nombre' => 'paso1_interalliance',
                'titulo' => 'Datos internos',
                'seccion' => 'Pre-registro',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'paso2_interalliance',
                'titulo' => 'Datos institución contraparte',
                'seccion' => 'Pre-registro',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'paso3_interalliance',
                'titulo' => 'Enviar Pre-registro',
                'seccion' => 'Pre-registro',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'paso4_interalliance',
                'titulo' => 'Datos de la Institución Destino',
                'seccion' => 'Registro',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'paso5_interalliance',
                'titulo' => 'Datos del representante legal externo',
                'seccion' => 'Registro',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'paso6_interalliance',
                'titulo' => 'Enviar Registro',
                'seccion' => 'Registro',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'paso1_interchange',
                'titulo' => 'Datos personales',
                'seccion' => 'Pre-inscripción',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'paso2_interchange',
                'titulo' => 'Información Académica',
                'seccion' => 'Pre-inscripción',
                'reglas' => '[{"estudiante_promedio":"between:3.5,5","estudiante_porcentaje_creditos":"between:20,100"}]',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'paso3_interchange',
                'titulo' => 'Información de movilidad',
                'seccion' => 'Pre-inscripción',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'paso4_interchange',
                'titulo' => 'Enviar la Pre-inscripción',
                'seccion' => 'Pre-inscripción',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'paso5_interchange',
                'titulo' => 'Datos Personales',
                'seccion' => 'Inscripción',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 12,
                'nombre' => 'paso6_interchange',
                'titulo' => 'Información Académica',
                'seccion' => 'Inscripción',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 13,
                'nombre' => 'paso7_interchange',
                'titulo' => 'Información de movilidad',
                'seccion' => 'Inscripción',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 14,
                'nombre' => 'paso8_interchange',
                'titulo' => 'Contacto en caso de emergencia',
                'seccion' => 'Inscripción',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 15,
                'nombre' => 'paso9_interchange',
                'titulo' => 'Fuentes de financiación',
                'seccion' => 'Inscripción',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 16,
                'nombre' => 'paso10_interchange',
                'titulo' => 'Presupuesto',
                'seccion' => 'Inscripción',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 17,
                'nombre' => 'paso11_interchange',
                'titulo' => 'Documentos de Soporte',
                'seccion' => 'Inscripción',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 18,
                'nombre' => 'paso12_interchange',
                'titulo' => 'Foto',
                'seccion' => 'Inscripción',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 19,
                'nombre' => 'paso13_interchange',
                'titulo' => 'Enviar Inscripción',
                'seccion' => 'Inscripción',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 20,
                'nombre' => 'paso14_interchange',
                'titulo' => 'Documentos finales',
                'seccion' => 'Documentos finales',
                'reglas' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}