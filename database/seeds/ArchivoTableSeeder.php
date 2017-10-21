<?php

use Illuminate\Database\Seeder;

class ArchivoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('archivo')->delete();
        
        \DB::table('archivo')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Representación Legal.pdf',
                'path' => 'institucion/1/Representacion Legal.pdf',
                'user_id' => 1,
                'formato_id' => 3,
                'tipo_archivo_id' => 1,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Acta de Nombramiento.pdf',
                'path' => 'institucion/1/Acta de Nombramiento.pdf',
                'user_id' => 1,
                'formato_id' => 3,
                'tipo_archivo_id' => 1,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Acta de Posesión.pdf',
                'path' => 'institucion/1/Acta de Posesion.pdf',
                'user_id' => 1,
                'formato_id' => 3,
                'tipo_archivo_id' => 1,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
            'nombre' => 'Cédula (C)(E).pdf',
            'path' => 'institucion/1/Cedula (C)(E).pdf',
                'user_id' => 1,
                'formato_id' => 3,
                'tipo_archivo_id' => 1,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'Cámara de Comercio.pdf',
                'path' => 'institucion/1/Camara de Comercio.pdf',
                'user_id' => 1,
                'formato_id' => 3,
                'tipo_archivo_id' => 1,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'Resolución/Decreto.pdf',
                'path' => 'institucion/1/Resolucion-Decreto.pdf',
                'user_id' => 1,
                'formato_id' => 3,
                'tipo_archivo_id' => 1,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'Personería Jurídica.pdf',
                'path' => 'institucion/1/Personeria Juridica.pdf',
                'user_id' => 1,
                'formato_id' => 3,
                'tipo_archivo_id' => 1,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
            'nombre' => 'Carta del Decano(a).pdf',
            'path' => 'institucion/1/Carta del Decano(a).pdf',
                'user_id' => 1,
                'formato_id' => 3,
                'tipo_archivo_id' => 1,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'diagrama_interactin.pdf',
                'path' => 'alianza/3/destination/9087ac3290f02f3bbb992d4954b1e486.diagrama_interactin.pdf',
                'user_id' => 3,
                'formato_id' => 3,
                'tipo_archivo_id' => 1,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-13 12:23:17',
                'updated_at' => '2017-09-20 17:21:51',
                'deleted_at' => '2017-09-20 17:21:51',
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'Borrador_Convenio_AGREEMENT FOR STUDENT EXCHANGES ',
                'path' => 'institucion/1/convenios/Borrador_Convenio_AGREEMENT FOR STUDENT EXCHANGES.html',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 1,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-20 17:21:51',
                'updated_at' => '2017-09-20 17:21:51',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'Borrador_Convenio_Doble_Titulación (1)',
                'path' => 'institucion/1/convenios/Borrador_Convenio_Doble_Titulación (1).htm',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 2,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-28 14:58:36',
                'updated_at' => '2017-09-28 14:58:36',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'nombre' => 'Borrador_Convenio_DOCENCIA – SERVICIO',
                'path' => 'institucion/1/convenios/Borrador_Convenio_DOCENCIA – SERVICIO.htm',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 2,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-28 14:58:36',
                'updated_at' => '2017-09-28 14:58:36',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'nombre' => 'Borrador_Convenio_GENERAL ACADEMIC AGREEMENT OF COOPERATION',
                'path' => 'institucion/1/convenios/Borrador_Convenio_GENERAL ACADEMIC AGREEMENT OF COOPERATION.htm',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 2,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-28 14:58:36',
                'updated_at' => '2017-09-28 14:58:36',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'nombre' => 'Borrador_Convenio_INMERSIÓN UNIVERSITARIA',
                'path' => 'institucion/1/convenios/Borrador_Convenio_INMERSIÓN UNIVERSITARIA.htm',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 2,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-28 14:58:36',
                'updated_at' => '2017-09-28 14:58:36',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'nombre' => 'Borrador_Convenio_MARCO ACADÉMICO DE COOPERACIÓN INTERINSTITUCIONAL',
                'path' => 'institucion/1/convenios/Borrador_Convenio_MARCO ACADÉMICO DE COOPERACIÓN INTERINSTITUCIONAL.htm',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 2,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-28 14:58:36',
                'updated_at' => '2017-09-28 14:58:36',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'nombre' => 'Borrador_Convenio_MARCO DE COOPERACIÓN PARA EL DESARROLLO DE ACTIVIDADES EN CIENCIA, TECNOLOGÍA E IN',
                'path' => 'institucion/1/convenios/Borrador_Convenio_MARCO DE COOPERACIÓN PARA EL DESARROLLO DE ACTIVIDADES EN CIENCIA, TECNOLOGÍA E INNOVACIÓN.htm',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 2,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-28 14:58:36',
                'updated_at' => '2017-09-28 14:58:36',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'nombre' => 'Borrador_Convenio_MEMORANDUM OF UNDERSTANDING ',
                'path' => 'institucion/1/convenios/Borrador_Convenio_MEMORANDUM OF UNDERSTANDING .htm',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 2,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-28 14:58:36',
                'updated_at' => '2017-09-28 14:58:36',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'nombre' => 'Borrador_Convenio_MOVILIDAD ACADÉMICA ESTUDIANTIL',
                'path' => 'institucion/1/convenios/Borrador_Convenio_MOVILIDAD ACADÉMICA ESTUDIANTIL.htm',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 2,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-28 14:58:36',
                'updated_at' => '2017-09-28 14:58:36',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'nombre' => 'Borrador_Convenio_PROYECTOS',
                'path' => 'institucion/1/convenios/Borrador_Convenio_PROYECTOS.htm',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 2,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-28 14:58:36',
                'updated_at' => '2017-09-28 14:58:36',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'nombre' => 'Borrador_Convenio_PRÁCTICAS O PASANTÍAS ACADÉMICAS ',
                'path' => 'institucion/1/convenios/Borrador_Convenio_PRÁCTICAS O PASANTÍAS ACADÉMICAS .htm',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 2,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-28 14:58:36',
                'updated_at' => '2017-09-28 14:58:36',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'nombre' => 'Borrador_Convenio_VISITING PROFESSOR OR RESEARCH SCHOLAR AGREEMENT',
                'path' => 'institucion/1/convenios/Borrador_Convenio_VISITING PROFESSOR OR RESEARCH SCHOLAR AGREEMENT.htm',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 2,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-28 14:58:36',
                'updated_at' => '2017-09-28 14:58:36',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'nombre' => 'CONVENIO DE COEDICION 2016',
                'path' => 'institucion/1/convenios/CONVENIO DE COEDICION 2016.htm',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 2,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-28 14:58:36',
                'updated_at' => '2017-09-28 14:58:36',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'nombre' => 'VISITING SCHOLAR AGREEMENT SUMMER ACADEMY 2017',
                'path' => 'institucion/1/convenios/VISITING SCHOLAR AGREEMENT SUMMER ACADEMY 2017.htm',
                'user_id' => 1,
                'formato_id' => 5,
                'tipo_archivo_id' => 2,
                'permisos_archivo' => '{owner:rwx,group:rw-,other:r--}',
                'created_at' => '2017-09-28 14:58:36',
                'updated_at' => '2017-09-28 14:58:36',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}