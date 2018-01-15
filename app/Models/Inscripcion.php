<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Inscripcion
 * @package App\Models
 * @version September 13, 2017, 10:23 am -05
 *
 */
class Inscripcion extends Model
{
    use SoftDeletes;

    public $table = 'inscripcion';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo',
        'user_id',
        'periodo_id',
        'modalidad_id',
        'programa_origen_id',
        'institucion_destino_id',
        'programa_destino_id',
        'fecha_inicio',
        'fecha_fin',
        'presupuesto_hospedaje',
        'presupuesto_alimentacion',
        'presupuesto_transporte',
        'presupuesto_otros',
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
        'tipo' => 'integer',
        'user_id' => 'integer',
        'periodo_id' => 'integer',
        'modalidad_id' => 'integer',
        'programa_origen_id' => 'integer',
        'institucion_destino_id' => 'integer',
        'programa_destino_id' => 'integer',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'presupuesto_hospedaje' => 'integer',
        'presupuesto_alimentacion' => 'integer',
        'presupuesto_transporte' => 'integer',
        'presupuesto_otros' => 'integer',
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

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function periodo()
    {
        return $this->belongsTo(\App\Models\Periodo::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function campus()
    {
        return $this->belongsTo(\App\Models\Admin\Campus::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function modalidad()
    {
        return $this->belongsTo(\App\Models\Modalidades::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function programa()
    {
        return $this->belongsTo(\App\Models\Programa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documentosInscripcion()
    {
        return $this->hasMany(\App\Models\DocumentosInscripcion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function evaluacion()
    {
        return $this->hasMany(\App\Models\Evaluacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function financiacion()
    {
        return $this->hasMany(\App\Models\Financiacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function inscripcionAsignaturas()
    {
        return $this->hasMany(\App\Models\InscripcionAsignatura::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pasosInscripcion()
    {
        return $this->hasMany(\App\Models\PasosInscripcion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function postulacion()
    {
        return $this->hasMany(\App\Models\Postulacion::class);
    }
}
