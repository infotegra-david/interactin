<?php

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'permission_id' => 1,
                'role_id' => 2,
            ),
            2 => 
            array (
                'permission_id' => 1,
                'role_id' => 3,
            ),
            3 => 
            array (
                'permission_id' => 2,
                'role_id' => 1,
            ),
            4 => 
            array (
                'permission_id' => 3,
                'role_id' => 1,
            ),
            5 => 
            array (
                'permission_id' => 4,
                'role_id' => 1,
            ),
            6 => 
            array (
                'permission_id' => 5,
                'role_id' => 1,
            ),
            7 => 
            array (
                'permission_id' => 6,
                'role_id' => 1,
            ),
            8 => 
            array (
                'permission_id' => 7,
                'role_id' => 1,
            ),
            9 => 
            array (
                'permission_id' => 8,
                'role_id' => 1,
            ),
            10 => 
            array (
                'permission_id' => 9,
                'role_id' => 1,
            ),
            11 => 
            array (
                'permission_id' => 9,
                'role_id' => 2,
            ),
            12 => 
            array (
                'permission_id' => 9,
                'role_id' => 3,
            ),
            13 => 
            array (
                'permission_id' => 9,
                'role_id' => 4,
            ),
            14 => 
            array (
                'permission_id' => 9,
                'role_id' => 5,
            ),
            15 => 
            array (
                'permission_id' => 9,
                'role_id' => 6,
            ),
            16 => 
            array (
                'permission_id' => 9,
                'role_id' => 12,
            ),
            17 => 
            array (
                'permission_id' => 10,
                'role_id' => 1,
            ),
            18 => 
            array (
                'permission_id' => 10,
                'role_id' => 3,
            ),
            19 => 
            array (
                'permission_id' => 10,
                'role_id' => 4,
            ),
            20 => 
            array (
                'permission_id' => 10,
                'role_id' => 5,
            ),
            21 => 
            array (
                'permission_id' => 11,
                'role_id' => 1,
            ),
            22 => 
            array (
                'permission_id' => 11,
                'role_id' => 3,
            ),
            23 => 
            array (
                'permission_id' => 11,
                'role_id' => 4,
            ),
            24 => 
            array (
                'permission_id' => 11,
                'role_id' => 5,
            ),
            25 => 
            array (
                'permission_id' => 12,
                'role_id' => 1,
            ),
            26 => 
            array (
                'permission_id' => 12,
                'role_id' => 4,
            ),
            27 => 
            array (
                'permission_id' => 13,
                'role_id' => 1,
            ),
            28 => 
            array (
                'permission_id' => 13,
                'role_id' => 2,
            ),
            29 => 
            array (
                'permission_id' => 13,
                'role_id' => 3,
            ),
            30 => 
            array (
                'permission_id' => 13,
                'role_id' => 6,
            ),
            31 => 
            array (
                'permission_id' => 13,
                'role_id' => 10,
            ),
            32 => 
            array (
                'permission_id' => 13,
                'role_id' => 11,
            ),
            33 => 
            array (
                'permission_id' => 13,
                'role_id' => 12,
            ),
            34 => 
            array (
                'permission_id' => 14,
                'role_id' => 1,
            ),
            35 => 
            array (
                'permission_id' => 14,
                'role_id' => 10,
            ),
            36 => 
            array (
                'permission_id' => 15,
                'role_id' => 1,
            ),
            37 => 
            array (
                'permission_id' => 15,
                'role_id' => 10,
            ),
            38 => 
            array (
                'permission_id' => 16,
                'role_id' => 1,
            ),
            39 => 
            array (
                'permission_id' => 16,
                'role_id' => 10,
            ),
            40 => 
            array (
                'permission_id' => 17,
                'role_id' => 1,
            ),
            41 => 
            array (
                'permission_id' => 17,
                'role_id' => 2,
            ),
            42 => 
            array (
                'permission_id' => 17,
                'role_id' => 3,
            ),
            43 => 
            array (
                'permission_id' => 17,
                'role_id' => 6,
            ),
            44 => 
            array (
                'permission_id' => 17,
                'role_id' => 11,
            ),
            45 => 
            array (
                'permission_id' => 17,
                'role_id' => 12,
            ),
            46 => 
            array (
                'permission_id' => 18,
                'role_id' => 1,
            ),
            47 => 
            array (
                'permission_id' => 18,
                'role_id' => 3,
            ),
            48 => 
            array (
                'permission_id' => 19,
                'role_id' => 1,
            ),
            49 => 
            array (
                'permission_id' => 19,
                'role_id' => 3,
            ),
            50 => 
            array (
                'permission_id' => 20,
                'role_id' => 1,
            ),
            51 => 
            array (
                'permission_id' => 20,
                'role_id' => 3,
            ),
            52 => 
            array (
                'permission_id' => 21,
                'role_id' => 1,
            ),
            53 => 
            array (
                'permission_id' => 21,
                'role_id' => 2,
            ),
            54 => 
            array (
                'permission_id' => 21,
                'role_id' => 3,
            ),
            55 => 
            array (
                'permission_id' => 21,
                'role_id' => 6,
            ),
            56 => 
            array (
                'permission_id' => 21,
                'role_id' => 10,
            ),
            57 => 
            array (
                'permission_id' => 21,
                'role_id' => 11,
            ),
            58 => 
            array (
                'permission_id' => 21,
                'role_id' => 12,
            ),
            59 => 
            array (
                'permission_id' => 22,
                'role_id' => 1,
            ),
            60 => 
            array (
                'permission_id' => 22,
                'role_id' => 3,
            ),
            61 => 
            array (
                'permission_id' => 22,
                'role_id' => 10,
            ),
            62 => 
            array (
                'permission_id' => 23,
                'role_id' => 1,
            ),
            63 => 
            array (
                'permission_id' => 23,
                'role_id' => 3,
            ),
            64 => 
            array (
                'permission_id' => 23,
                'role_id' => 10,
            ),
            65 => 
            array (
                'permission_id' => 24,
                'role_id' => 1,
            ),
            66 => 
            array (
                'permission_id' => 24,
                'role_id' => 3,
            ),
            67 => 
            array (
                'permission_id' => 24,
                'role_id' => 10,
            ),
            68 => 
            array (
                'permission_id' => 25,
                'role_id' => 1,
            ),
            69 => 
            array (
                'permission_id' => 25,
                'role_id' => 2,
            ),
            70 => 
            array (
                'permission_id' => 25,
                'role_id' => 3,
            ),
            71 => 
            array (
                'permission_id' => 25,
                'role_id' => 4,
            ),
            72 => 
            array (
                'permission_id' => 25,
                'role_id' => 5,
            ),
            73 => 
            array (
                'permission_id' => 25,
                'role_id' => 6,
            ),
            74 => 
            array (
                'permission_id' => 25,
                'role_id' => 7,
            ),
            75 => 
            array (
                'permission_id' => 25,
                'role_id' => 8,
            ),
            76 => 
            array (
                'permission_id' => 25,
                'role_id' => 9,
            ),
            77 => 
            array (
                'permission_id' => 25,
                'role_id' => 10,
            ),
            78 => 
            array (
                'permission_id' => 25,
                'role_id' => 11,
            ),
            79 => 
            array (
                'permission_id' => 25,
                'role_id' => 12,
            ),
            80 => 
            array (
                'permission_id' => 26,
                'role_id' => 1,
            ),
            81 => 
            array (
                'permission_id' => 27,
                'role_id' => 1,
            ),
            82 => 
            array (
                'permission_id' => 28,
                'role_id' => 1,
            ),
            83 => 
            array (
                'permission_id' => 29,
                'role_id' => 1,
            ),
            84 => 
            array (
                'permission_id' => 29,
                'role_id' => 2,
            ),
            85 => 
            array (
                'permission_id' => 29,
                'role_id' => 3,
            ),
            86 => 
            array (
                'permission_id' => 29,
                'role_id' => 4,
            ),
            87 => 
            array (
                'permission_id' => 29,
                'role_id' => 5,
            ),
            88 => 
            array (
                'permission_id' => 29,
                'role_id' => 6,
            ),
            89 => 
            array (
                'permission_id' => 29,
                'role_id' => 7,
            ),
            90 => 
            array (
                'permission_id' => 29,
                'role_id' => 8,
            ),
            91 => 
            array (
                'permission_id' => 29,
                'role_id' => 9,
            ),
            92 => 
            array (
                'permission_id' => 29,
                'role_id' => 10,
            ),
            93 => 
            array (
                'permission_id' => 29,
                'role_id' => 11,
            ),
            94 => 
            array (
                'permission_id' => 29,
                'role_id' => 12,
            ),
            95 => 
            array (
                'permission_id' => 30,
                'role_id' => 1,
            ),
            96 => 
            array (
                'permission_id' => 31,
                'role_id' => 1,
            ),
            97 => 
            array (
                'permission_id' => 32,
                'role_id' => 1,
            ),
            98 => 
            array (
                'permission_id' => 33,
                'role_id' => 1,
            ),
            99 => 
            array (
                'permission_id' => 33,
                'role_id' => 2,
            ),
            100 => 
            array (
                'permission_id' => 33,
                'role_id' => 3,
            ),
            101 => 
            array (
                'permission_id' => 33,
                'role_id' => 4,
            ),
            102 => 
            array (
                'permission_id' => 33,
                'role_id' => 5,
            ),
            103 => 
            array (
                'permission_id' => 33,
                'role_id' => 6,
            ),
            104 => 
            array (
                'permission_id' => 33,
                'role_id' => 7,
            ),
            105 => 
            array (
                'permission_id' => 33,
                'role_id' => 8,
            ),
            106 => 
            array (
                'permission_id' => 33,
                'role_id' => 9,
            ),
            107 => 
            array (
                'permission_id' => 33,
                'role_id' => 10,
            ),
            108 => 
            array (
                'permission_id' => 33,
                'role_id' => 11,
            ),
            109 => 
            array (
                'permission_id' => 33,
                'role_id' => 12,
            ),
            110 => 
            array (
                'permission_id' => 34,
                'role_id' => 1,
            ),
            111 => 
            array (
                'permission_id' => 35,
                'role_id' => 1,
            ),
            112 => 
            array (
                'permission_id' => 36,
                'role_id' => 1,
            ),
            113 => 
            array (
                'permission_id' => 37,
                'role_id' => 1,
            ),
            114 => 
            array (
                'permission_id' => 37,
                'role_id' => 6,
            ),
            115 => 
            array (
                'permission_id' => 37,
                'role_id' => 12,
            ),
            116 => 
            array (
                'permission_id' => 37,
                'role_id' => 13,
            ),
            117 => 
            array (
                'permission_id' => 38,
                'role_id' => 1,
            ),
            118 => 
            array (
                'permission_id' => 38,
                'role_id' => 6,
            ),
            119 => 
            array (
                'permission_id' => 39,
                'role_id' => 1,
            ),
            120 => 
            array (
                'permission_id' => 39,
                'role_id' => 6,
            ),
            121 => 
            array (
                'permission_id' => 40,
                'role_id' => 1,
            ),
            122 => 
            array (
                'permission_id' => 40,
                'role_id' => 6,
            ),
            123 => 
            array (
                'permission_id' => 41,
                'role_id' => 1,
            ),
            124 => 
            array (
                'permission_id' => 41,
                'role_id' => 3,
            ),
            125 => 
            array (
                'permission_id' => 41,
                'role_id' => 4,
            ),
            126 => 
            array (
                'permission_id' => 41,
                'role_id' => 5,
            ),
            127 => 
            array (
                'permission_id' => 41,
                'role_id' => 6,
            ),
            128 => 
            array (
                'permission_id' => 41,
                'role_id' => 12,
            ),
            129 => 
            array (
                'permission_id' => 42,
                'role_id' => 1,
            ),
            130 => 
            array (
                'permission_id' => 42,
                'role_id' => 3,
            ),
            131 => 
            array (
                'permission_id' => 43,
                'role_id' => 1,
            ),
            132 => 
            array (
                'permission_id' => 44,
                'role_id' => 1,
            ),
            133 => 
            array (
                'permission_id' => 45,
                'role_id' => 1,
            ),
            134 => 
            array (
                'permission_id' => 46,
                'role_id' => 1,
            ),
            135 => 
            array (
                'permission_id' => 47,
                'role_id' => 1,
            ),
            136 => 
            array (
                'permission_id' => 48,
                'role_id' => 1,
            ),
            137 => 
            array (
                'permission_id' => 49,
                'role_id' => 1,
            ),
            138 => 
            array (
                'permission_id' => 49,
                'role_id' => 6,
            ),
            139 => 
            array (
                'permission_id' => 49,
                'role_id' => 13,
            ),
            140 => 
            array (
                'permission_id' => 50,
                'role_id' => 1,
            ),
            141 => 
            array (
                'permission_id' => 50,
                'role_id' => 6,
            ),
            142 => 
            array (
                'permission_id' => 51,
                'role_id' => 1,
            ),
            143 => 
            array (
                'permission_id' => 51,
                'role_id' => 6,
            ),
            144 => 
            array (
                'permission_id' => 52,
                'role_id' => 1,
            ),
            145 => 
            array (
                'permission_id' => 52,
                'role_id' => 6,
            ),
            146 => 
            array (
                'permission_id' => 53,
                'role_id' => 1,
            ),
            147 => 
            array (
                'permission_id' => 53,
                'role_id' => 3,
            ),
            148 => 
            array (
                'permission_id' => 54,
                'role_id' => 1,
            ),
            149 => 
            array (
                'permission_id' => 54,
                'role_id' => 3,
            ),
            150 => 
            array (
                'permission_id' => 55,
                'role_id' => 1,
            ),
            151 => 
            array (
                'permission_id' => 55,
                'role_id' => 3,
            ),
            152 => 
            array (
                'permission_id' => 56,
                'role_id' => 1,
            ),
            153 => 
            array (
                'permission_id' => 56,
                'role_id' => 3,
            ),
            154 => 
            array (
                'permission_id' => 57,
                'role_id' => 1,
            ),
            155 => 
            array (
                'permission_id' => 58,
                'role_id' => 1,
            ),
            156 => 
            array (
                'permission_id' => 59,
                'role_id' => 1,
            ),
            157 => 
            array (
                'permission_id' => 60,
                'role_id' => 1,
            ),
            158 => 
            array (
                'permission_id' => 61,
                'role_id' => 1,
            ),
            159 => 
            array (
                'permission_id' => 62,
                'role_id' => 1,
            ),
            160 => 
            array (
                'permission_id' => 63,
                'role_id' => 1,
            ),
            161 => 
            array (
                'permission_id' => 64,
                'role_id' => 1,
            ),
            162 => 
            array (
                'permission_id' => 65,
                'role_id' => 1,
            ),
            163 => 
            array (
                'permission_id' => 66,
                'role_id' => 1,
            ),
            164 => 
            array (
                'permission_id' => 67,
                'role_id' => 1,
            ),
            165 => 
            array (
                'permission_id' => 68,
                'role_id' => 1,
            ),
            166 => 
            array (
                'permission_id' => 69,
                'role_id' => 1,
            ),
            167 => 
            array (
                'permission_id' => 70,
                'role_id' => 1,
            ),
            168 => 
            array (
                'permission_id' => 71,
                'role_id' => 1,
            ),
            169 => 
            array (
                'permission_id' => 72,
                'role_id' => 1,
            ),
            170 => 
            array (
                'permission_id' => 73,
                'role_id' => 1,
            ),
            171 => 
            array (
                'permission_id' => 74,
                'role_id' => 1,
            ),
            172 => 
            array (
                'permission_id' => 75,
                'role_id' => 1,
            ),
            173 => 
            array (
                'permission_id' => 76,
                'role_id' => 1,
            ),
            174 => 
            array (
                'permission_id' => 77,
                'role_id' => 1,
            ),
            175 => 
            array (
                'permission_id' => 78,
                'role_id' => 1,
            ),
            176 => 
            array (
                'permission_id' => 79,
                'role_id' => 1,
            ),
            177 => 
            array (
                'permission_id' => 80,
                'role_id' => 1,
            ),
        ));
        
        
    }
}