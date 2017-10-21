<?php

namespace App\Repositories\Validation;

use App\Models\Validation\PasosIniciativa;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PasosIniciativaRepository
 * @package App\Repositories\Validation
 * @version October 2, 2017, 2:44 pm -05
 *
 * @method PasosIniciativa findWithoutFail($id, $columns = ['*'])
 * @method PasosIniciativa find($id, $columns = ['*'])
 * @method PasosIniciativa first($columns = ['*'])
*/
class PasosIniciativaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_paso_id',
        'estado_id',
        'user_id',
        'observacion',
        'iniciativa_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PasosIniciativa::class;
    }
}
