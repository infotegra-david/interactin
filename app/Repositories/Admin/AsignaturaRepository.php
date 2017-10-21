<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Asignatura;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AsignaturaRepository
 * @package App\Repositories\Admin
 * @version September 26, 2017, 12:15 pm -05
 *
 * @method Asignatura findWithoutFail($id, $columns = ['*'])
 * @method Asignatura find($id, $columns = ['*'])
 * @method Asignatura first($columns = ['*'])
*/
class AsignaturaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'codigo',
        'nro_creditos',
        'programa_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Asignatura::class;
    }
}
