<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Programa;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProgramaRepository
 * @package App\Repositories\Admin
 * @version September 26, 2017, 12:04 pm -05
 *
 * @method Programa findWithoutFail($id, $columns = ['*'])
 * @method Programa find($id, $columns = ['*'])
 * @method Programa first($columns = ['*'])
*/
class ProgramaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'facultad_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Programa::class;
    }
    /**
     * Lista los registros segun el id pasado por parametro.
     *
     * @param  int 
     *
     * @return Response
     */
    public function listPrograms($facultad_id = null)
    {
        if (!is_array($facultad_id)){
            $facultad_id = array($facultad_id);
        }
        return Programa::whereIn('facultad_id', $facultad_id)->pluck('nombre','id');
    }
}
