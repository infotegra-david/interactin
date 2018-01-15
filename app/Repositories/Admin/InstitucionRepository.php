<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Institucion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class InstitucionRepository
 * @package App\Repositories\Admin
 * @version September 26, 2017, 10:40 am -05
 *
 * @method Institucion findWithoutFail($id, $columns = ['*'])
 * @method Institucion find($id, $columns = ['*'])
 * @method Institucion first($columns = ['*'])
*/
class InstitucionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'email',
        'tipo_institucion_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Institucion::class;
    }

    
    /**
     * Lista las instituciones segun la modalidad_id
     *
     * @param int $pais_id
     *
     * @return list states
     */
    public function listInstitutions($institucion_id, $pais_id, $modalidad_id) 
    {
        $ciudades = \App\Models\Admin\State::join('ciudad', 'departamento.id', '=', 'ciudad.departamento_id')->where('departamento.pais_id', $pais_id)->pluck('ciudad.id');

        $institucionesId = \App\Models\Alianza::join('alianza_modalidades', 'alianza.id', '=', 'alianza_modalidades.alianza_id')
            ->join('alianza_institucion', 'alianza.id', '=', 'alianza_institucion.alianza_id')
            ->where('alianza_modalidades.modalidades_id', $modalidad_id)
            ->where('alianza_institucion.institucion_id','<>', $institucion_id)
            ->pluck('alianza_institucion.institucion_id');

        $instituciones = Institucion::join('campus', 'institucion.id', '=', 'campus.institucion_id')
            ->whereIn('institucion.id', $institucionesId)
            ->where('campus.principal',1)
            ->whereIn('campus.ciudad_id', $ciudades)
            ->pluck('institucion.nombre','institucion.id');



        return $instituciones;
    } 
}
