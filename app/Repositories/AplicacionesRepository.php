<?php

namespace App\Repositories;

use App\Models\Aplicaciones;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AplicacionesRepository
 * @package App\Repositories
 * @version September 10, 2017, 6:30 pm COT
 *
 * @method Aplicaciones findWithoutFail($id, $columns = ['*'])
 * @method Aplicaciones find($id, $columns = ['*'])
 * @method Aplicaciones first($columns = ['*'])
*/
class AplicacionesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'tipo_alianza_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Aplicaciones::class;
    }


    /**
     * Lista los registros segun el id pasado por parametro.
     *
     * @param  int 
     *
     * @return Response
     */
    public function listAplicaciones($tipo_alianza_id = null)
    {
        return Aplicaciones::where('tipo_alianza_id', $tipo_alianza_id)->pluck('nombre','id');
    }
}
