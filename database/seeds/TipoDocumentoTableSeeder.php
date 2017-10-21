<?php

use Illuminate\Database\Seeder;

class TipoDocumentoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipo_documento')->delete();
        
        \DB::table('tipo_documento')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'REPRESENTACIÓN LEGAL',
                'clase_documento_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'ACTA DE NOMBRAMIENTO',
                'clase_documento_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'ACTA DE POSESIÓN',
                'clase_documento_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
            'nombre' => 'CÉDULA (C)(E)',
                'clase_documento_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'CÁMARA DE COMERCIO',
                'clase_documento_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'RESOLUCIÓN/DECRETO',
                'clase_documento_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'PERSONERÍA JURÍDICA',
                'clase_documento_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
            'nombre' => 'CARTA DEL DECANO(A)',
                'clase_documento_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'PRE-FORMAS',
                'clase_documento_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'PRE-FORMAS',
                'clase_documento_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'CÉDULA DE CIUDADANÍA',
                'clase_documento_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'nombre' => 'CÉDULA DE EXTRANJERÍA',
                'clase_documento_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'nombre' => 'PASAPORTE',
                'clase_documento_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'nombre' => 'DOCUMENTOS FINALES ALIANZA',
                'clase_documento_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}