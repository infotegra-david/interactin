<?php

namespace App\Repositories;

use App\Models\Estado;
use InfyOm\Generator\Common\BaseRepository;

class EstadoRepository extends BaseRepository
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
        return Estado::class;
    }
}
