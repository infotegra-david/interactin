<?php

namespace App\Repositories;

use App\Models\Financiacion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FinanciacionRepository
 * @package App\Repositories
 * @version December 27, 2017, 10:55 pm -05
 *
 * @method Financiacion findWithoutFail($id, $columns = ['*'])
 * @method Financiacion find($id, $columns = ['*'])
 * @method Financiacion first($columns = ['*'])
*/
class FinanciacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'inscripcion_id',
        'fuente_financiacion_id',
        'monto'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Financiacion::class;
    }
}
