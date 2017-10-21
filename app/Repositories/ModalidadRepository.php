<?php

namespace App\Repositories;

use App\Models\Modalidad;
use InfyOm\Generator\Common\BaseRepository;

class ModalidadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'tipo_alianza_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Modalidad::class;
    }



    /**
     * Lista los registros segun el id pasado por parametro.
     *
     * @param  int 
     *
     * @return Response
     */
    public function listModalidades($tipo_alianza_id = null)
    {
        return Modalidad::where('tipo_alianza_id', $tipo_alianza_id)->pluck('nombre','id');
    }
}
