<?php

namespace App\Repositories\Validation;

use App\Models\Validation\PasosInscripcion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PasosInscripcionRepository
 * @package App\Repositories
 * @version September 12, 2017, 9:57 am -05
 *
 * @method PasosInscripcion findWithoutFail($id, $columns = ['*'])
 * @method PasosInscripcion find($id, $columns = ['*'])
 * @method PasosInscripcion first($columns = ['*'])
*/
class PasosInscripcionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_paso_id',
        'estado_id',
        'user_id',
        'observacion',
        'inscripcion_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PasosInscripcion::class;
    }
}
