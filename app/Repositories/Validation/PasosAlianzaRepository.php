<?php

namespace App\Repositories\Validation;

use App\Models\Validation\PasosAlianza;
use InfyOm\Generator\Common\BaseRepository;

class PasosAlianzaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha',
        'validador_id',
        'tipo_paso_id',
        'estado_id',
        'observacion',
        'alianza_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PasosAlianza::class;
    }
}
