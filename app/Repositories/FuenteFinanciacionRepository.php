<?php

namespace App\Repositories;

use App\Models\FuenteFinanciacion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FuenteFinanciacionRepository
 * @package App\Repositories
 * @version December 27, 2017, 5:22 pm -05
 *
 * @method FuenteFinanciacion findWithoutFail($id, $columns = ['*'])
 * @method FuenteFinanciacion find($id, $columns = ['*'])
 * @method FuenteFinanciacion first($columns = ['*'])
*/
class FuenteFinanciacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'tipo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FuenteFinanciacion::class;
    }
}
