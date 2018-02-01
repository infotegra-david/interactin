<?php

namespace App\Repositories;

use App\Models\TipoDocumento;
use InfyOm\Generator\Common\BaseRepository;

class TipoDocumentoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'clasificacion_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TipoDocumento::class;
    }


    /**
     * Lista las instituciones segun la modalidad_id
     *
     * @param int $pais_id
     *
     * @return list states
     */
    public function listDocumentType($institucion_id) 
    {
        //agregar el campo 'Otro' para que agreguen una nueva unidad (tipo_documento)
        $clasificacion = \App\Models\Clasificacion::whereIn('nombre',['INSTITUCION','ALIANZA'])->pluck('id');
        $tipo_documento = $this->tipo_documento->whereIn('clasificacion_id',$clasificacion)->select('nombre','id')->pluck('nombre','id');
        
        //$tipo_documento = $this->tipo_documento->select(DB::raw("'Otro' AS nombre, '999999' AS id"))->union($tipo_documento_todos)->pluck('nombre','id');
        
        $ciudades = \App\Models\Admin\State::join('ciudad', 'departamento.id', '=', 'ciudad.departamento_id')->where('departamento.pais_id', $pais_id)->pluck('ciudad.id');

        $instituciones = Institucion::join('campus', 'institucion.id', '=', 'campus.institucion_id')->where('institucion.id','<>', $institucion_id)->whereIn('campus.ciudad_id', $ciudades)->pluck('institucion.nombre','institucion.id');

        return $instituciones;

    } 
}
