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
        'user_id',
        'fecha',
        'periodo_id',
        'campus_id',
        'modalidades_id',
        'programa_origen_id',
        'programa_destino_id',
        'fecha_inicio',
        'fecha_fin',
        'presupuesto_hospedaje',
        'presupuesto_alimentacion',
        'presupuesto_transporte',
        'presupuesto_otros'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'fecha' => 'date',
        'periodo_id' => 'integer',
        'campus_id' => 'integer',
        'modalidades_id' => 'integer',
        'programa_origen_id' => 'integer',
        'programa_destino_id' => 'integer',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'presupuesto_hospedaje' => 'integer',
        'presupuesto_alimentacion' => 'integer',
        'presupuesto_transporte' => 'integer',
        'presupuesto_otros' => 'integer'
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
    public function documentosInscripcions()
    {
        return $this->hasMany(\App\Models\DocumentosInscripcion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function evaluacions()
    {
        return $this->hasMany(\App\Models\Evaluacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function financiacions()
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
    public function pasosInscripcions()
    {
        return $this->hasMany(\App\Models\PasosInscripcion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function postulacions()
    {
        return $this->hasMany(\App\Models\Postulacion::class);
    }
}
