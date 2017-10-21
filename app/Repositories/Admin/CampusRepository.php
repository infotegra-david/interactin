<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Campus;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CampusRepository
 * @package App\Repositories\Admin
 * @version September 26, 2017, 11:46 am -05
 *
 * @method Campus findWithoutFail($id, $columns = ['*'])
 * @method Campus find($id, $columns = ['*'])
 * @method Campus first($columns = ['*'])
*/
class CampusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'institucion_id',
        'telefono',
        'direccion',
        'codigo_postal',
        'email',
        'ciudad_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Campus::class;
    }

    
    /**
     * Lista los campus segun la institucion_id
     *
     * @param int $institucion_id
     *
     * @return list states
     */
    public function listCampus($institucion_id) 
    {
        

        $campus = Campus::join('institucion', 'institucion.id', '=', 'campus.institucion_id')->where('institucion.id', $institucion_id)->pluck('campus.nombre','campus.id');

        return $campus;
    } 
}
