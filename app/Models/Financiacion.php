<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Financiacion
 * @package App\Models
 * @version December 27, 2017, 10:55 pm -05
 *
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer inscripcion_id
 * @property integer fuente_financiacion_id
 * @property integer monto
 */
class Financiacion extends Model
{
    use SoftDeletes;

    public $table = 'financiacion';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'inscripcion_id',
        'fuente_financiacion_id',
        'monto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'inscripcion_id' => 'integer',
        'fuente_financiacion_id' => 'integer',
        'monto' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
