<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DatosPersonales
 * @package App\Models
 * @version June 29, 2017, 2:39 pm COT
 */
class DatosPersonales extends Model
{
    use SoftDeletes;

    public $table = 'datos_personales';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombres',
        'apellidos',
        'ciudad_residencia_id',
        'direccion',
        'email_personal',
        'telefono',
        'celular',
        'codigo_postal',
        'tipo_documento_id',
        'numero_documento',
        'fecha_expedicion',
        'fecha_vencimiento',
        'lugar_expedicion_id',
        'nacionalidad_id',
        'nro_pasaporte',
        'fecha_expedicion_pasaporte',
        'fecha_vencimiento_pasaporte',
        'porcentaje_aprobado',
        'promedio_acumulado',
        'codigo_institucion',
        'cargo',
        'facultad_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombres' => 'string',
        'apellidos' => 'string',
        'ciudad_residencia_id' => 'integer',
        'direccion' => 'string',
        'email_personal' => 'string',
        'telefono' => 'string',
        'celular' => 'string',
        'codigo_postal' => 'string',
        'tipo_documento_id' => 'integer',
        'numero_documento' => 'string',
        'fecha_expedicion' => 'date',
        'fecha_vencimiento' => 'date',
        'lugar_expedicion_id' => 'integer',
        'nacionalidad_id' => 'integer',
        'nro_pasaporte' => 'string',
        'fecha_expedicion_pasaporte' => 'date',
        'fecha_vencimiento_pasaporte' => 'date',
        'porcentaje_aprobado' => 'integer',
        'promedio_acumulado' => 'float',
        'codigo_institucion' => 'string',
        'cargo' => 'string',
        'facultad_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function ciudad()
    {
        return $this->belongsTo(\App\Models\Ciudad::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipoIdentificacion()
    {
        return $this->belongsTo(\App\Models\TipoIdentificacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(\App\User::class);
    }
}
