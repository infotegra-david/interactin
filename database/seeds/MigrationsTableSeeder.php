<?php

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '2017_09_13_095549_create_alianza_aplicaciones_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'migration' => '2017_09_13_095549_create_alianza_facultad_table',
                'batch' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'migration' => '2017_09_13_095549_create_alianza_institucion_table',
                'batch' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'migration' => '2017_09_13_095549_create_alianza_modalidades_table',
                'batch' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'migration' => '2017_09_13_095549_create_alianza_programa_table',
                'batch' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'migration' => '2017_09_13_095549_create_alianza_table',
                'batch' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'migration' => '2017_09_13_095549_create_alianza_user_table',
                'batch' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'migration' => '2017_09_13_095549_create_aplicaciones_table',
                'batch' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'migration' => '2017_09_13_095549_create_archivo_table',
                'batch' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'migration' => '2017_09_13_095549_create_asignatura_table',
                'batch' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'migration' => '2017_09_13_095549_create_calificacion_table',
                'batch' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'migration' => '2017_09_13_095549_create_campus_table',
                'batch' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'migration' => '2017_09_13_095549_create_ciudad_table',
                'batch' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'migration' => '2017_09_13_095549_create_clase_documento_table',
                'batch' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'migration' => '2017_09_13_095549_create_datos_personales_table',
                'batch' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'migration' => '2017_09_13_095549_create_departamento_table',
                'batch' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'migration' => '2017_09_13_095549_create_documentos_iniciativa_table',
                'batch' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'migration' => '2017_09_13_095549_create_documentos_inscripcion_table',
                'batch' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'migration' => '2017_09_13_095549_create_documentos_institucion_table',
                'batch' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'migration' => '2017_09_13_095549_create_documentos_oportunidad_table',
                'batch' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'migration' => '2017_09_13_095549_create_equivalente_table',
                'batch' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'migration' => '2017_09_13_095549_create_estado_table',
                'batch' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'migration' => '2017_09_13_095549_create_evaluacion_table',
                'batch' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'migration' => '2017_09_13_095549_create_facultad_table',
                'batch' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'migration' => '2017_09_13_095549_create_financiacion_table',
                'batch' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'migration' => '2017_09_13_095549_create_formato_table',
                'batch' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'migration' => '2017_09_13_095549_create_fuente_financiacion_table',
                'batch' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'migration' => '2017_09_13_095549_create_idiomas_table',
                'batch' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'migration' => '2017_09_13_095549_create_iniciativa_actor_table',
                'batch' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'migration' => '2017_09_13_095549_create_iniciativa_table',
                'batch' => 1,
            ),
            30 => 
            array (
                'id' => 31,
                'migration' => '2017_09_13_095549_create_inscripcion_asignatura_table',
                'batch' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'migration' => '2017_09_13_095549_create_inscripcion_table',
                'batch' => 1,
            ),
            32 => 
            array (
                'id' => 33,
                'migration' => '2017_09_13_095549_create_institucion_table',
                'batch' => 1,
            ),
            33 => 
            array (
                'id' => 34,
                'migration' => '2017_09_13_095549_create_mail_archivo_table',
                'batch' => 1,
            ),
            34 => 
            array (
                'id' => 35,
                'migration' => '2017_09_13_095549_create_mail_table',
                'batch' => 1,
            ),
            35 => 
            array (
                'id' => 36,
                'migration' => '2017_09_13_095549_create_matricula_table',
                'batch' => 1,
            ),
            36 => 
            array (
                'id' => 37,
                'migration' => '2017_09_13_095549_create_modalidades_table',
                'batch' => 1,
            ),
            37 => 
            array (
                'id' => 38,
                'migration' => '2017_09_13_095549_create_multimedia_table',
                'batch' => 1,
            ),
            38 => 
            array (
                'id' => 39,
                'migration' => '2017_09_13_095549_create_nivel_table',
                'batch' => 1,
            ),
            39 => 
            array (
                'id' => 40,
                'migration' => '2017_09_13_095549_create_oportunidad_actor_table',
                'batch' => 1,
            ),
            40 => 
            array (
                'id' => 41,
                'migration' => '2017_09_13_095549_create_oportunidad_modalidades_table',
                'batch' => 1,
            ),
            41 => 
            array (
                'id' => 42,
                'migration' => '2017_09_13_095549_create_oportunidad_table',
                'batch' => 1,
            ),
            42 => 
            array (
                'id' => 43,
                'migration' => '2017_09_13_095549_create_pagina_table',
                'batch' => 1,
            ),
            43 => 
            array (
                'id' => 44,
                'migration' => '2017_09_13_095549_create_pais_table',
                'batch' => 1,
            ),
            44 => 
            array (
                'id' => 45,
                'migration' => '2017_09_13_095549_create_pasos_alianza_mail_table',
                'batch' => 1,
            ),
            45 => 
            array (
                'id' => 46,
                'migration' => '2017_09_13_095549_create_pasos_alianza_table',
                'batch' => 1,
            ),
            46 => 
            array (
                'id' => 47,
                'migration' => '2017_09_13_095549_create_pasos_iniciativa_mail_table',
                'batch' => 1,
            ),
            47 => 
            array (
                'id' => 48,
                'migration' => '2017_09_13_095549_create_pasos_iniciativa_table',
                'batch' => 1,
            ),
            48 => 
            array (
                'id' => 49,
                'migration' => '2017_09_13_095549_create_pasos_inscripcion_mail_table',
                'batch' => 1,
            ),
            49 => 
            array (
                'id' => 50,
                'migration' => '2017_09_13_095549_create_pasos_inscripcion_table',
                'batch' => 1,
            ),
            50 => 
            array (
                'id' => 51,
                'migration' => '2017_09_13_095549_create_password_resets_table',
                'batch' => 1,
            ),
            51 => 
            array (
                'id' => 52,
                'migration' => '2017_09_13_095549_create_periodo_table',
                'batch' => 1,
            ),
            52 => 
            array (
                'id' => 53,
                'migration' => '2017_09_13_095549_create_persona_contacto_table',
                'batch' => 1,
            ),
            53 => 
            array (
                'id' => 54,
                'migration' => '2017_09_13_095549_create_postulacion_table',
                'batch' => 1,
            ),
            54 => 
            array (
                'id' => 55,
                'migration' => '2017_09_13_095549_create_programa_table',
                'batch' => 1,
            ),
            55 => 
            array (
                'id' => 56,
                'migration' => '2017_09_13_095549_create_rol_iniciativa_table',
                'batch' => 1,
            ),
            56 => 
            array (
                'id' => 57,
                'migration' => '2017_09_13_095549_create_seccion_table',
                'batch' => 1,
            ),
            57 => 
            array (
                'id' => 58,
                'migration' => '2017_09_13_095549_create_tipo_actor_table',
                'batch' => 1,
            ),
            58 => 
            array (
                'id' => 59,
                'migration' => '2017_09_13_095549_create_tipo_alianza_table',
                'batch' => 1,
            ),
            59 => 
            array (
                'id' => 60,
                'migration' => '2017_09_13_095549_create_tipo_archivo_table',
                'batch' => 1,
            ),
            60 => 
            array (
                'id' => 61,
                'migration' => '2017_09_13_095549_create_tipo_documento_table',
                'batch' => 1,
            ),
            61 => 
            array (
                'id' => 62,
                'migration' => '2017_09_13_095549_create_tipo_facultad_table',
                'batch' => 1,
            ),
            62 => 
            array (
                'id' => 63,
                'migration' => '2017_09_13_095549_create_tipo_idioma_table',
                'batch' => 1,
            ),
            63 => 
            array (
                'id' => 64,
                'migration' => '2017_09_13_095549_create_tipo_institucion_table',
                'batch' => 1,
            ),
            64 => 
            array (
                'id' => 65,
                'migration' => '2017_09_13_095549_create_tipo_paso_table',
                'batch' => 1,
            ),
            65 => 
            array (
                'id' => 66,
                'migration' => '2017_09_13_095549_create_tipo_tramite_table',
                'batch' => 1,
            ),
            66 => 
            array (
                'id' => 67,
                'migration' => '2017_09_13_095549_create_user_campus_table',
                'batch' => 1,
            ),
            67 => 
            array (
                'id' => 68,
                'migration' => '2017_09_13_095549_create_user_tipo_paso_mail_table',
                'batch' => 1,
            ),
            68 => 
            array (
                'id' => 69,
                'migration' => '2017_09_13_095549_create_user_tipo_paso_table',
                'batch' => 1,
            ),
            69 => 
            array (
                'id' => 70,
                'migration' => '2017_09_13_095549_create_users_table',
                'batch' => 1,
            ),
            70 => 
            array (
                'id' => 71,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_alianza_aplicaciones_table',
                'batch' => 1,
            ),
            71 => 
            array (
                'id' => 72,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_alianza_facultad_table',
                'batch' => 1,
            ),
            72 => 
            array (
                'id' => 73,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_alianza_institucion_table',
                'batch' => 1,
            ),
            73 => 
            array (
                'id' => 74,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_alianza_modalidades_table',
                'batch' => 1,
            ),
            74 => 
            array (
                'id' => 75,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_alianza_programa_table',
                'batch' => 1,
            ),
            75 => 
            array (
                'id' => 76,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_alianza_table',
                'batch' => 2,
            ),
            76 => 
            array (
                'id' => 77,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_alianza_user_table',
                'batch' => 2,
            ),
            77 => 
            array (
                'id' => 78,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_aplicaciones_table',
                'batch' => 2,
            ),
            78 => 
            array (
                'id' => 79,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_archivo_table',
                'batch' => 2,
            ),
            79 => 
            array (
                'id' => 80,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_asignatura_table',
                'batch' => 2,
            ),
            80 => 
            array (
                'id' => 81,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_campus_table',
                'batch' => 2,
            ),
            81 => 
            array (
                'id' => 82,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_ciudad_table',
                'batch' => 2,
            ),
            82 => 
            array (
                'id' => 83,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_datos_personales_table',
                'batch' => 2,
            ),
            83 => 
            array (
                'id' => 84,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_departamento_table',
                'batch' => 2,
            ),
            84 => 
            array (
                'id' => 85,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_documentos_iniciativa_table',
                'batch' => 2,
            ),
            85 => 
            array (
                'id' => 86,
                'migration' => '2017_09_13_095554_add_foreign_keys_to_documentos_inscripcion_table',
                'batch' => 2,
            ),
            86 => 
            array (
                'id' => 87,
                'migration' => '2017_10_04_144316_create_alianza_table',
                'batch' => 2,
            ),
            87 => 
            array (
                'id' => 88,
                'migration' => '2017_10_04_144316_create_alianza_aplicaciones_table',
                'batch' => 2,
            ),
            88 => 
            array (
                'id' => 89,
                'migration' => '2017_10_04_144316_create_alianza_facultad_table',
                'batch' => 2,
            ),
            89 => 
            array (
                'id' => 90,
                'migration' => '2017_10_04_144316_create_alianza_institucion_table',
                'batch' => 2,
            ),
            90 => 
            array (
                'id' => 91,
                'migration' => '2017_10_04_144316_create_alianza_modalidades_table',
                'batch' => 2,
            ),
            91 => 
            array (
                'id' => 92,
                'migration' => '2017_10_04_144316_create_alianza_programa_table',
                'batch' => 0,
            ),
            92 => 
            array (
                'id' => 93,
                'migration' => '2017_10_04_144316_create_alianza_user_table',
                'batch' => 0,
            ),
            93 => 
            array (
                'id' => 94,
                'migration' => '2017_10_04_144316_create_aplicaciones_table',
                'batch' => 0,
            ),
            94 => 
            array (
                'id' => 95,
                'migration' => '2017_10_04_144316_create_archivo_table',
                'batch' => 0,
            ),
            95 => 
            array (
                'id' => 96,
                'migration' => '2017_10_04_144316_create_asignatura_table',
                'batch' => 0,
            ),
            96 => 
            array (
                'id' => 97,
                'migration' => '2017_10_04_144316_create_calificacion_table',
                'batch' => 0,
            ),
            97 => 
            array (
                'id' => 98,
                'migration' => '2017_10_04_144316_create_campus_table',
                'batch' => 0,
            ),
            98 => 
            array (
                'id' => 99,
                'migration' => '2017_10_04_144316_create_ciudad_table',
                'batch' => 0,
            ),
            99 => 
            array (
                'id' => 100,
                'migration' => '2017_10_04_144316_create_clase_documento_table',
                'batch' => 0,
            ),
            100 => 
            array (
                'id' => 101,
                'migration' => '2017_10_04_144316_create_datos_personales_table',
                'batch' => 0,
            ),
            101 => 
            array (
                'id' => 102,
                'migration' => '2017_10_04_144316_create_departamento_table',
                'batch' => 0,
            ),
            102 => 
            array (
                'id' => 103,
                'migration' => '2017_10_04_144316_create_documentos_alianza_table',
                'batch' => 0,
            ),
            103 => 
            array (
                'id' => 104,
                'migration' => '2017_10_04_144316_create_documentos_iniciativa_table',
                'batch' => 0,
            ),
            104 => 
            array (
                'id' => 105,
                'migration' => '2017_10_04_144316_create_documentos_inscripcion_table',
                'batch' => 0,
            ),
            105 => 
            array (
                'id' => 106,
                'migration' => '2017_10_04_144316_create_documentos_institucion_table',
                'batch' => 0,
            ),
            106 => 
            array (
                'id' => 107,
                'migration' => '2017_10_04_144316_create_documentos_oportunidad_table',
                'batch' => 0,
            ),
            107 => 
            array (
                'id' => 108,
                'migration' => '2017_10_04_144316_create_equivalente_table',
                'batch' => 0,
            ),
            108 => 
            array (
                'id' => 109,
                'migration' => '2017_10_04_144316_create_estado_table',
                'batch' => 0,
            ),
            109 => 
            array (
                'id' => 110,
                'migration' => '2017_10_04_144316_create_evaluacion_table',
                'batch' => 0,
            ),
            110 => 
            array (
                'id' => 111,
                'migration' => '2017_10_04_144316_create_facultad_table',
                'batch' => 0,
            ),
            111 => 
            array (
                'id' => 112,
                'migration' => '2017_10_04_144316_create_financiacion_table',
                'batch' => 0,
            ),
            112 => 
            array (
                'id' => 113,
                'migration' => '2017_10_04_144316_create_formato_table',
                'batch' => 0,
            ),
            113 => 
            array (
                'id' => 114,
                'migration' => '2017_10_04_144316_create_fuente_financiacion_table',
                'batch' => 0,
            ),
            114 => 
            array (
                'id' => 115,
                'migration' => '2017_10_04_144316_create_idiomas_table',
                'batch' => 0,
            ),
            115 => 
            array (
                'id' => 116,
                'migration' => '2017_10_04_144316_create_iniciativa_table',
                'batch' => 0,
            ),
            116 => 
            array (
                'id' => 117,
                'migration' => '2017_10_04_144316_create_iniciativa_actor_table',
                'batch' => 0,
            ),
            117 => 
            array (
                'id' => 118,
                'migration' => '2017_10_04_144316_create_inscripcion_table',
                'batch' => 0,
            ),
            118 => 
            array (
                'id' => 119,
                'migration' => '2017_10_04_144316_create_inscripcion_asignatura_table',
                'batch' => 0,
            ),
            119 => 
            array (
                'id' => 120,
                'migration' => '2017_10_04_144316_create_institucion_table',
                'batch' => 0,
            ),
            120 => 
            array (
                'id' => 121,
                'migration' => '2017_10_04_144316_create_mail_table',
                'batch' => 0,
            ),
            121 => 
            array (
                'id' => 122,
                'migration' => '2017_10_04_144316_create_mail_archivo_table',
                'batch' => 0,
            ),
            122 => 
            array (
                'id' => 123,
                'migration' => '2017_10_04_144316_create_matricula_table',
                'batch' => 0,
            ),
            123 => 
            array (
                'id' => 124,
                'migration' => '2017_10_04_144316_create_modalidades_table',
                'batch' => 0,
            ),
            124 => 
            array (
                'id' => 125,
                'migration' => '2017_10_04_144316_create_model_has_permissions_table',
                'batch' => 0,
            ),
            125 => 
            array (
                'id' => 126,
                'migration' => '2017_10_04_144316_create_model_has_roles_table',
                'batch' => 0,
            ),
            126 => 
            array (
                'id' => 127,
                'migration' => '2017_10_04_144316_create_multimedia_table',
                'batch' => 0,
            ),
            127 => 
            array (
                'id' => 128,
                'migration' => '2017_10_04_144316_create_nivel_table',
                'batch' => 0,
            ),
            128 => 
            array (
                'id' => 129,
                'migration' => '2017_10_04_144316_create_oportunidad_table',
                'batch' => 0,
            ),
            129 => 
            array (
                'id' => 130,
                'migration' => '2017_10_04_144316_create_oportunidad_actor_table',
                'batch' => 0,
            ),
            130 => 
            array (
                'id' => 131,
                'migration' => '2017_10_04_144316_create_oportunidad_modalidades_table',
                'batch' => 0,
            ),
            131 => 
            array (
                'id' => 132,
                'migration' => '2017_10_04_144316_create_pagina_table',
                'batch' => 0,
            ),
            132 => 
            array (
                'id' => 133,
                'migration' => '2017_10_04_144316_create_pais_table',
                'batch' => 0,
            ),
            133 => 
            array (
                'id' => 134,
                'migration' => '2017_10_04_144316_create_pasos_alianza_table',
                'batch' => 0,
            ),
            134 => 
            array (
                'id' => 135,
                'migration' => '2017_10_04_144316_create_pasos_alianza_mail_table',
                'batch' => 0,
            ),
            135 => 
            array (
                'id' => 136,
                'migration' => '2017_10_04_144316_create_pasos_iniciativa_table',
                'batch' => 0,
            ),
            136 => 
            array (
                'id' => 137,
                'migration' => '2017_10_04_144316_create_pasos_iniciativa_mail_table',
                'batch' => 0,
            ),
            137 => 
            array (
                'id' => 138,
                'migration' => '2017_10_04_144316_create_pasos_inscripcion_table',
                'batch' => 0,
            ),
            138 => 
            array (
                'id' => 139,
                'migration' => '2017_10_04_144316_create_pasos_inscripcion_mail_table',
                'batch' => 0,
            ),
            139 => 
            array (
                'id' => 140,
                'migration' => '2017_10_04_144316_create_password_resets_table',
                'batch' => 0,
            ),
            140 => 
            array (
                'id' => 141,
                'migration' => '2017_10_04_144316_create_periodo_table',
                'batch' => 0,
            ),
            141 => 
            array (
                'id' => 142,
                'migration' => '2017_10_04_144316_create_permissions_table',
                'batch' => 0,
            ),
            142 => 
            array (
                'id' => 143,
                'migration' => '2017_10_04_144316_create_persona_contacto_table',
                'batch' => 0,
            ),
            143 => 
            array (
                'id' => 144,
                'migration' => '2017_10_04_144316_create_postulacion_table',
                'batch' => 0,
            ),
            144 => 
            array (
                'id' => 145,
                'migration' => '2017_10_04_144316_create_programa_table',
                'batch' => 0,
            ),
            145 => 
            array (
                'id' => 146,
                'migration' => '2017_10_04_144316_create_rol_iniciativa_table',
                'batch' => 0,
            ),
            146 => 
            array (
                'id' => 147,
                'migration' => '2017_10_04_144316_create_role_has_permissions_table',
                'batch' => 0,
            ),
            147 => 
            array (
                'id' => 148,
                'migration' => '2017_10_04_144316_create_roles_table',
                'batch' => 0,
            ),
            148 => 
            array (
                'id' => 149,
                'migration' => '2017_10_04_144316_create_seccion_table',
                'batch' => 0,
            ),
            149 => 
            array (
                'id' => 150,
                'migration' => '2017_10_04_144316_create_tipo_actor_table',
                'batch' => 0,
            ),
            150 => 
            array (
                'id' => 151,
                'migration' => '2017_10_04_144316_create_tipo_alianza_table',
                'batch' => 0,
            ),
            151 => 
            array (
                'id' => 152,
                'migration' => '2017_10_04_144316_create_tipo_archivo_table',
                'batch' => 0,
            ),
            152 => 
            array (
                'id' => 153,
                'migration' => '2017_10_04_144316_create_tipo_documento_table',
                'batch' => 0,
            ),
            153 => 
            array (
                'id' => 154,
                'migration' => '2017_10_04_144316_create_tipo_facultad_table',
                'batch' => 0,
            ),
            154 => 
            array (
                'id' => 155,
                'migration' => '2017_10_04_144316_create_tipo_idioma_table',
                'batch' => 0,
            ),
            155 => 
            array (
                'id' => 156,
                'migration' => '2017_10_04_144316_create_tipo_institucion_table',
                'batch' => 0,
            ),
            156 => 
            array (
                'id' => 157,
                'migration' => '2017_10_04_144316_create_tipo_paso_table',
                'batch' => 0,
            ),
            157 => 
            array (
                'id' => 158,
                'migration' => '2017_10_04_144316_create_tipo_tramite_table',
                'batch' => 0,
            ),
            158 => 
            array (
                'id' => 159,
                'migration' => '2017_10_04_144316_create_user_campus_table',
                'batch' => 0,
            ),
            159 => 
            array (
                'id' => 160,
                'migration' => '2017_10_04_144316_create_user_tipo_paso_table',
                'batch' => 0,
            ),
            160 => 
            array (
                'id' => 161,
                'migration' => '2017_10_04_144316_create_user_tipo_paso_mail_table',
                'batch' => 0,
            ),
            161 => 
            array (
                'id' => 162,
                'migration' => '2017_10_04_144316_create_users_table',
                'batch' => 0,
            ),
            162 => 
            array (
                'id' => 163,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_alianza_table',
                'batch' => 0,
            ),
            163 => 
            array (
                'id' => 164,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_alianza_aplicaciones_table',
                'batch' => 0,
            ),
            164 => 
            array (
                'id' => 165,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_alianza_facultad_table',
                'batch' => 0,
            ),
            165 => 
            array (
                'id' => 166,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_alianza_institucion_table',
                'batch' => 0,
            ),
            166 => 
            array (
                'id' => 167,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_alianza_modalidades_table',
                'batch' => 0,
            ),
            167 => 
            array (
                'id' => 168,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_alianza_programa_table',
                'batch' => 0,
            ),
            168 => 
            array (
                'id' => 169,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_alianza_user_table',
                'batch' => 0,
            ),
            169 => 
            array (
                'id' => 170,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_aplicaciones_table',
                'batch' => 0,
            ),
            170 => 
            array (
                'id' => 171,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_archivo_table',
                'batch' => 0,
            ),
            171 => 
            array (
                'id' => 172,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_asignatura_table',
                'batch' => 0,
            ),
            172 => 
            array (
                'id' => 173,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_campus_table',
                'batch' => 0,
            ),
            173 => 
            array (
                'id' => 174,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_ciudad_table',
                'batch' => 0,
            ),
            174 => 
            array (
                'id' => 175,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_datos_personales_table',
                'batch' => 0,
            ),
            175 => 
            array (
                'id' => 176,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_departamento_table',
                'batch' => 0,
            ),
            176 => 
            array (
                'id' => 177,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_documentos_alianza_table',
                'batch' => 0,
            ),
            177 => 
            array (
                'id' => 178,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_documentos_iniciativa_table',
                'batch' => 0,
            ),
            178 => 
            array (
                'id' => 179,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_documentos_inscripcion_table',
                'batch' => 0,
            ),
            179 => 
            array (
                'id' => 180,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_documentos_iniciativa_table',
                'batch' => 0,
            ),
            180 => 
            array (
                'id' => 181,
                'migration' => '2017_10_04_144322_add_foreign_keys_to_documentos_inscripcion_table',
                'batch' => 0,
            ),
        ));
        
        
    }
}