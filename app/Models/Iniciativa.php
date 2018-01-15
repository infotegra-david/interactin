<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Iniciativa
 * @package App\Models
 * @version October 31, 2017, 3:21 pm -05
 *
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer oportunidad_id
 * @property string titulo
 * @property string objetivo
 * @property string integracion_agenda_origen
 * @property string responsabilidades_origen
 * @property string beneficios_origen
 * @property boolean recursos_origen
 * @property integer presupuesto_costo_total
 * @property integer presupuesto_otros_actores
 * @property integer presupuesto_total_origen
 * @property integer presupuesto_financieros
 * @property integer presupuesto_personal
 * @property integer presupuesto_infraestructura
 * @property integer presupuesto_otro
 * @property string instrumentos_monitoreo
 * @property boolean firma_rectoria
 */
class Iniciativa extends Model
{
    use SoftDeletes;

    public $table = 'iniciativa';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'oportunidad_id',
        'titulo',
        'objetivo',
        'integracion_agenda_origen',
        'responsabilidades_origen',
        'beneficios_origen',
        'recursos_origen',
        'presupuesto_costo_total',
        'presupuesto_otros_actores',
        'presupuesto_total_origen',
        'presupuesto_financieros',
        'presupuesto_personal',
        'presupuesto_infraestructura',
        'presupuesto_otro',
        'instrumentos_monitoreo',
        'firma_rectoria',
        'campus_id',
        'estado_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'oportunidad_id' => 'integer',
        'titulo' => 'string',
        'objetivo' => 'string',
        'integracion_agenda_origen' => 'string',
        'responsabilidades_origen' => 'string',
        'beneficios_origen' => 'string',
        'recursos_origen' => 'boolean',
        'presupuesto_costo_total' => 'integer',
        'presupuesto_otros_actores' => 'integer',
        'presupuesto_total_origen' => 'integer',
        'presupuesto_financieros' => 'integer',
        'presupuesto_personal' => 'integer',
        'presupuesto_infraestructura' => 'integer',
        'presupuesto_otro' => 'integer',
        'instrumentos_monitoreo' => 'string',
        'firma_rectoria' => 'boolean',
        'campus_id' => 'integer',
        'estado_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
