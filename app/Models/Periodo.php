<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Periodo
 * @package App\Models
 * @version September 11, 2017, 11:59 am COT
 *
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
