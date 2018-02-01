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
                'clasificacion_id' => 3,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'ACTA DE NOMBRAMIENTO',
                'clasificacion_id' => 3,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'ACTA DE POSESIÓN',
                'clasificacion_id' => 3,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'CÁMARA DE COMERCIO',
                'clasificacion_id' => 3,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'RESOLUCIÓN/DECRETO',
                'clasificacion_id' => 3,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'PERSONERÍA JURÍDICA',
                'clasificacion_id' => 3,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
            'nombre' => 'CARTA DEL DECANO(A)',
                'clasificacion_id' => 3,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'PRE-FORMAS',
                'clasificacion_id' => 3,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'PRE-FORMAS',
                'clasificacion_id' => 6,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'CÉDULA DE CIUDADANÍA',
                'clasificacion_id' => 7,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'CÉDULA DE EXTRANJERÍA',
                'clasificacion_id' => 7,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'nombre' => 'PASAPORTE',
                'clasificacion_id' => 7,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'nombre' => 'DOCUMENTOS FINALES ALIANZA',
                'clasificacion_id' => 6,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'nombre' => 'DOCUMENTOS SOPORTE',
                'clasificacion_id' => 2,
                'descripcion' => '[{"nombre": "Certificado de notas", "descripcion": ""},{"nombre": "Pasaporte", "descripcion": ""},{"nombre": "Carta de intención del estudiante", "descripcion": ""},{"nombre": "Carta de recomendación de un profesor", "descripcion": ""},{"nombre": "Hoja de vida", "descripcion": ""},{"nombre": "Carta de compromiso padres - acudientes", "descripcion": ""},{"nombre": "Formulario de inscripcion destino", "descripcion": ""},{"nombre": "Certificado conocimiento del idioma destino", "descripcion": ""}]',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'nombre' => 'FOTO',
                'clasificacion_id' => 2,
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'nombre' => 'DOCUMENTOS FINALES INSCRIPCION',
                'clasificacion_id' => 2,
                'descripcion' => '[{"nombre": "Recibo de derechos de movilidad cancelado", "descripcion": ""},{"nombre": "Seguro medico internacional", "descripcion": ""},{"nombre": "Visado otorgado (Si aplica)", "descripcion": ""},{"nombre": "Tiquete aéreo", "descripcion": ""},{"nombre": "Carta de compromiso según tipo de movilidad", "descripcion": "Semestre Académico (<a href=\'archivo1.pdf\'>Descargar</a>) <br> Prácticas o Pasantías (<a href=\'archivo2.pdf\'>Descargar</a>)"}]',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}