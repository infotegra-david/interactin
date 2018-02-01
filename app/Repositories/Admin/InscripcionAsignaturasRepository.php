<?php

namespace App\Repositories\Admin;

use App\Models\Admin\InscripcionAsignaturas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class InscripcionAsignaturasRepository
 * @package App\Repositories\Admin
 * @version January 22, 2018, 10:03 am -05
 *
 * @method InscripcionAsignaturas findWithoutFail($id, $columns = ['*'])
 * @method InscripcionAsignaturas find($id, $columns = ['*'])
 * @method InscripcionAsignaturas first($columns = ['*'])
*/
class InscripcionAsignaturasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'inscripcion_id',
        'equivalentes_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return InscripcionAsignaturas::class;
    }
}
