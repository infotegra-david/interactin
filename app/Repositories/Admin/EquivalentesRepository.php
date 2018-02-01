<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Equivalentes;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EquivalentesRepository
 * @package App\Repositories\Admin
 * @version January 22, 2018, 10:17 am -05
 *
 * @method Equivalentes findWithoutFail($id, $columns = ['*'])
 * @method Equivalentes find($id, $columns = ['*'])
 * @method Equivalentes first($columns = ['*'])
*/
class EquivalentesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'asignatura_origen_id',
        'asignatura_destino_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Equivalentes::class;
    }
}
