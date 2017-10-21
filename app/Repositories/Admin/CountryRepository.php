<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Country;
use InfyOm\Generator\Common\BaseRepository;

class CountryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Country::class;
    }

    /**
     * Comprueba si hay departamentos relacionados para el pais segun el id_pais pasado por parametro.
     *
     * @param  int $id_pais
     *
     * @return Boolean
     */
    public function related_states($id_pais)
    {
        if(isset(Country::has('states')->find($id_pais)->states)){
            return true;
        }
        return false;
    }

    /**
     * Valida que el nombre y el codigo ingresado al crear o actualizar pais sean unicos.
     *
     * @param  string $nombre 
     * @param  string $codigo
     * @param  int $id = null
     *
     * @return Boolean
     */
    public function validar($nombre, $codigo, $id = null)
    {
        $registros = 0;
        if (empty($id)){
            $registros = Country::where('nombre','=', strtoupper($nombre))->orWhere('codigo_ref', '=', $codigo)->get()->count();
        }else{
            $_SESSION['pais'] = strtoupper($nombre);
            $_SESSION['codigo'] = $codigo;
            $registros = Country::where('id', '!=', $id)->where(function($q){ $q->where('nombre','=', $_SESSION['pais'])->orWhere('codigo_ref', '=', $_SESSION['codigo']); })->get()->count();
        }
        if($registros > 0){
            return true;
        }
        return false;     
    }

    /**
     * Filtro por nombre de pais.
     *
     * @param  string $country
     *
     * @return result query countries
     */
    public function search($country)
    {
        $countries = Country::Where('nombre','LIKE','%' . strtoupper($country) . '%')->paginate(20);
        return $countries;
    }



    /**
     * Lista los paises segun la institucion_id
     *
     * @param int $institucion_id
     *
     * @return list countries
     */
    public function listCountriesModalidad($modalidad_id) 
    {
        $instituciones = \App\Models\Modalidades::join('alianza_modalidades', 'modalidades.id', '=', 'alianza_modalidades.modalidades_id')->join('alianza', 'alianza_modalidades.alianza_id', '=', 'alianza.id')->join('alianza_institucion', 'alianza.id', '=', 'alianza_institucion.alianza_id')->where('modalidades.id', $modalidad_id)->pluck('alianza_institucion.institucion_id');
        $ciudades = \App\Models\Admin\Institucion::join('campus', 'institucion.id', '=', 'campus.institucion_id')->whereIn('institucion.id', $instituciones)->pluck('campus.ciudad_id');
        $paises = \App\Models\Admin\State::join('ciudad', 'departamento.id', '=', 'ciudad.departamento_id')->whereIn('ciudad.id', $ciudades)->pluck('departamento.pais_id');

        return Country::whereIn('id', $paises)->pluck('nombre','id');
    } 
}
