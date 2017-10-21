<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Periodo
 * @package App\Models
 * @version September 11, 2017, 11:59 am COT
 *
 * @property \Illuminate\Database\Eloquent\Collection alianzaAplicaciones
 * @property \Illuminate\Database\Eloquent\Collection alianzaFacultad
 * @property \Illuminate\Database\Eloquent\Collection alianzaInstitucion
 * @property \Illuminate\Database\Eloquent\Collection alianzaModalidades
 * @property \Illuminate\Database\Eloquent\Collection alianzaPrograma
 * @property \Illuminate\Database\Eloquent\Collection alianzaUser
 * @property \Illuminate\Database\Eloquent\Collection campus
 * @property \Illuminate\Database\Eloquent\Collection equivalente
 * @property \Illuminate\Database\Eloquent\Collection facultad
 * @property \Illuminate\Database\Eloquent\Collection financiacion
 * @property \Illuminate\Database\Eloquent\Collection Inscripcion
 * @property \Illuminate\Database\Eloquent\Collection inscripcionAsignatura
 * @property \Illuminate\Database\Eloquent\Collection mailArchivo
 * @property \Illuminate\Database\Eloquent\Collection matricula
 * @property \Illuminate\Database\Eloquent\Collection multimedia
 * @property \Illuminate\Database\Eloquent\Collection oportunidadActor
 * @property \Illuminate\Database\Eloquent\Collection oportunidadModalidades
 * @property \Illuminate\Database\Eloquent\Collection pasosAlianzaMail
 * @property \Illuminate\Database\Eloquent\Collection pasosIniciativaMail
 * @property \Illuminate\Database\Eloquent\Collection pasosInscripcionMail
 * @property \Illuminate\Database\Eloquent\Collection personaContacto
 * @property \Illuminate\Database\Eloquent\Collection postulacion
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property \Illuminate\Database\Eloquent\Collection userTipoPaso
 * @property \Illuminate\Database\Eloquent\Collection userTipoPasoMail
 * @property string nombre
 * @property string|\Carbon\Carbon fecha_desde
 * @property string|\Carbon\Carbon fecha_hasta
 * @property boolean vigente
 */
class Periodo extends Model
{
    use SoftDeletes;

    public $table = 'periodo';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'fecha_desde',
        'fecha_hasta',
        'vigente'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'vigente' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function inscripcions()
    {
        return $this->hasMany(\App\Models\Inscripcion::class);
    }
}
