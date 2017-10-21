<?php

namespace App\Repositories;

use App\Models\TipoAlianza;
use InfyOm\Generator\Common\BaseRepository;

class TipoAlianzaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TipoAlianza::class;
    }
}
