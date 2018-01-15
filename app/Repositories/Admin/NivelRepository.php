<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Nivel;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class NivelRepository
 * @package App\Repositories\Admin
 * @version December 22, 2017, 5:50 pm -05
 *
 * @method Nivel findWithoutFail($id, $columns = ['*'])
 * @method Nivel find($id, $columns = ['*'])
 * @method Nivel first($columns = ['*'])
*/
class NivelRepository extends BaseRepository
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
        return Nivel::class;
    }
}
