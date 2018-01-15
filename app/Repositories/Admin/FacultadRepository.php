<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Facultad;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FacultadRepository
 * @package App\Repositories\Admin
 * @version September 26, 2017, 12:00 pm -05
 *
 * @method Facultad findWithoutFail($id, $columns = ['*'])
 * @method Facultad find($id, $columns = ['*'])
 * @method Facultad first($columns = ['*'])
*/
class FacultadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'campus_id',
        'tipo_facultad_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Facultad::class;
    }
    /**
     * Lista los registros segun el id pasado por parametro.
     *
     * @param  int 
     *
     * @return Response
     */
    public function listFaculties($campus_id = null)
    {
        if (!is_array($campus_id)){
            $campus_id = array($campus_id);
        }
        return Facultad::whereIn('campus_id', $campus_id)->pluck('nombre','id');
    }
}
