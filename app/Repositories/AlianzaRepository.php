<?php

namespace App\Repositories;

use App\Models\Alianza;
use InfyOm\Generator\Common\BaseRepository;

class AlianzaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'usuario_id',
        'objetivo',
        'tipo_tramite_id',
        'duracion',
        'responsable_arl',
        'estado'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Alianza::class;
    }
}
